<?php
namespace Nos\Comments;

class API
{
    protected static $key = 'comments';

    public static $_config_per_model = array();
    protected $_config;

    public function __construct($config)
    {
        $this->_config = $config;
    }

    public static function processRequest()
    {
        $model = $_REQUEST['model'];
        \Nos\Controller::overrideCurrentApplication($model::getApplication());
        $config = static::getConfigurationFromModel($model);
        $config['model'] = $model;
        $api = new static($config);
        $api->execute($_REQUEST);
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

    public function addCommentAction($data)
    {
        $ret = $this->addComment($data);
        \Session::set_flash('noviusos_comment::add_comment_success', $ret);
        if ($ret == false) {
            \Session::set_flash('noviusos_comment::comm_email', $data['comm_email']);
            \Session::set_flash('noviusos_comment::comm_author', $data['comm_author']);
            \Session::set_flash('noviusos_comment::comm_content', $data['comm_content']);
        }
        \Response::redirect(\Input::referrer());
    }

    public function addComment($data)
    {
        if (!isset($this->_config['default_state'])) {
            $this->_config['default_state'] = 'published';
        }

        if (!isset($this->_config['use_recaptcha'])) {
            $this->_config['use_recaptcha'] = false;
        }

        if ($data['ismm'] == '327') {
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

                \Event::trigger_function('noviusos_comments|front->_add_comment', array(&$comm, &$item));

                $comm->save();

                \Cookie::set('comm_email', $data['comm_email']);
                \Cookie::set('comm_author', $data['comm_author']);

                return true;
            } else {
                return false;
            }
        }

        return 'none';
    }

    public static function addCommentsToRss(&$rss, $comments)
    {
        $items = array();
        foreach ($comments as $comment) {
            $item = static::getRssComment($comment);
            if (!empty($item)) {
                $items[] = $item;
            }
        }

        $rss->set_items($comments);
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
}