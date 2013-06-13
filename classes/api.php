<?php
namespace Nos\Comments;

class API
{
    protected static $key = 'comments';

    public static $_config_per_model = array();
    protected $_config;

    public function __construct($config_or_model)
    {
        if (strpos($config_or_model, '::') === false) {
            $model = $config_or_model;

            $config_or_model = static::getConfigurationFromModel($model);
            $config_or_model['model'] = $model;
        }
        $this->_config = $config_or_model;

        list($application_name, $file_name) = \Config::configFile(get_called_class());

        $this->_config = \Arr::merge(
            \Config::loadConfiguration($application_name, $file_name),
            $this->_config
        );
    }

    public function getConfig()
    {
        return $this->_config;
    }

    public static function getConfigurationFromModel($model)
    {
        if (!isset(static::$_config_per_model[$model])) {
            static::$_config_per_model[$model] = \Arr::get(\Nos\Config_Common::load($model), 'api.'.static::$key, null);
        }
        return static::$_config_per_model[$model];
    }

    public function execute($data)
    {
        $action = $data['action'];
        if (substr($action, 0, 1) === '_') {
            throw new \Exception('Invalid API method!');
        }
        $this->{$action.'Action'}($data);
    }

    public function addComment($data)
    {
        if ($data['ismm'] == $this->_config['anti_spam_identifier']['passed']) {
            if (!$this->_config['use_recaptcha'] || (
                \Package::load('fuel-recatpcha', APPPATH.'packages/fuel-recaptcha/') &&
                \ReCaptcha\ReCaptcha::instance()->check_answer(
                    \Input::real_ip(),
                    $data['recaptcha_challenge_field'],
                    $data['recaptcha_response_field']
                )
            )
            ) {
                $model = $this->_config['model'];
                $item = $model::find($data['id']);
                $comm = new Model_Comment();
                $comm->comm_foreign_model = $this->_config['model'];
                $comm->comm_email = $data['comm_email'];
                $comm->comm_author = $data['comm_author'];
                $comm->comm_content = $data['comm_content'];
                $comm->comm_created_at = \Date::forge()->format('mysql');
                $comm->comm_foreign_id = $data['id'];
                $comm->comm_state = $this->_config['default_state'];
                $comm->comm_ip = \Input::ip();

                \Event::trigger_function('noviusos_comments::before_comment', array(&$comm, &$item));

                $comm->save();

                \Cookie::set('comm_email', $data['comm_email']);
                \Cookie::set('comm_author', $data['comm_author']);

                if ($this->_config['send_email']['to_author']) {
                    $this->sendNewCommentToAuthor($comm, $item);
                }

                if ($this->_config['send_email']['to_commenters']) {
                    $this->sendNewCommentToCommenters($comm, $item);
                }

                \Event::trigger('noviusos_comments::after_comment', array(&$comm, &$item));

                \Session::set_flash('noviusos_comment::add_comment_success', true);
                return true;
            } else {
                \Session::set_flash('noviusos_comment::add_comment_success', false);
                \Session::set_flash('noviusos_comment::comm_email', $data['comm_email']);
                \Session::set_flash('noviusos_comment::comm_author', $data['comm_author']);
                \Session::set_flash('noviusos_comment::comm_content', $data['comm_content']);
                return false;
            }
        }

        return 'none';
    }

    public function sendNewCommentToAuthor($comment, $item)
    {
        $mail = \Email::forge();
        $mail->to($item->author->user_email);
        $mail->subject(strtr(__('{{item_title}}: New comment'), array('{{item_title}}' => $item->title)));
        $mail->html_body(\View::forge('noviusos_comments::email/admin', array('comment' => $comment, 'item' => $item)));

        try {
            $mail->send();
        } catch (\Exception $e) {
            logger(\Fuel::L_ERROR, 'The Comments application cannot send emails - '.$e->getMessage());
        }
    }

    public function sendNewCommentToCommenters($comment, $item)
    {
        $emails = array();
        foreach ($item->comments as $comment) {
            $emails[$comment->comm_email] = $comment->comm_author;
        }

        $mail = \Email::forge();
        $mail->bcc($emails);
        $mail->subject(strtr(__('{{item_title}}: New comment'), array('{{item_title}}' => $item->title)));
        $mail->html_body(\View::forge('noviusos_comments::email/commenters', array('comment' => $comment, 'item' => $item)));

        try {
            $mail->send();
        } catch (\Exception $e) {
            logger(\Fuel::L_ERROR, 'The Comments application cannot send emails - '.$e->getMessage());
        }
    }

    public static function getRssComment($comment)
    {
        $parent_item = $comment->getRelatedItem();
        if (empty($parent_item)) {
            return null;
        }
        $item = array();
        $item['title'] = strtr(__('Comment to the post ‘{{post}}’.'), array('{{post}}' => $parent_item->post_title));
        $item['link'] = $parent_item->url_canonical().'#comment'.$comment->comm_id;
        $item['description'] = $comment->comm_content;
        $item['pubDate'] = $comment->comm_created_at;
        $item['author'] = $comment->comm_author;

        return $item;
    }

    public function getRss($options = array())
    {
        $rss = \Nos\Tools_RSS::forge(array(
            'link' => \Nos\Nos::main_controller()->getUrl(),
            'language' => \Nos\Tools_Context::locale(\Nos\Nos::main_controller()->getPage()->page_context),
        ));

        $find_options = array(
            'order_by'              => array('comm_created_at' => 'DESC'),
            'where' => array(
                'comm_foreign_model' => $options['model'],
            ),
            'limit'                 => $this->_config['rss']['model']['nb'],
        );

        if (isset($options['item'])) {
            $item = $options['item'];
            if (empty($item)) {
                throw new \Nos\NotFoundException();
            }

            $find_options['where']['comm_foreign_id'] = $item->id;
            $find_options['limit'] = $this->_config['rss']['item']['nb'];
        }

        $comments = \Nos\Comments\Model_Comment::find('all', $find_options);

        $rss_items = array();
        foreach ($comments as $comment) {
            $rss_item = $this->getRssComment($comment);
            if (!empty($comment)) {
                $rss_items[] = $rss_item;
            }
        }

        $rss->set_items($rss_items);


        return $rss;
    }
}