<?php
namespace Nos\Comments;

class API
{
    protected $_config;

    public static function forge(array $config = array())
    {
        return new static($config);
    }

    /**
     * @param array $config API configuration
     */
    public function __construct(array $config = array())
    {
        $this->_config = \Arr::merge(
            \Config::load('noviusos_comments::api', true),
            $config
        );
    }

    /**
     * @return $config the API configuration
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * Adds a comment to an item from datas sent from a comment's form.
     *
     * @param $data comment's form data
     * @return bool|string "none" if nothing was done, true if the comment was
     * successfully added, false otherwise.
     */
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
                $comm->comm_context = !empty($data['comm_context']) ? $data['comm_context'] : \Nos\Nos::main_controller()->getContext();
                $comm->comm_foreign_model = $model;
                $comm->comm_email = $data['comm_email'];
                $comm->comm_author = $data['comm_author'];
                $comm->comm_content = $data['comm_content'];
                $comm->comm_created_at = \Date::forge()->format('mysql');
                $comm->comm_foreign_id = $data['id'];
                $comm->comm_state = $this->_config['default_state'];
                $comm->comm_ip = \Input::ip();
                $comm->comm_subscribed = isset($data['subscribe_to_comments']) && $data['subscribe_to_comments'];

                \Event::trigger_function('noviusos_comments::before_comment', array(&$comm, &$item));

                $comm->save();

                \Cookie::set('comm_email', $data['comm_email']);
                \Cookie::set('comm_author', $data['comm_author']);

                $this->sendNewCommentToAuthor($comm);
                $this->sendNewCommentToCommenters($comm);

                \Event::trigger('noviusos_comments::after_comment', array(&$comm, &$item));

                \Session::set_flash('noviusos_comment::add_comment_success', $this->_config['default_state'] == 'pending' ? 2 : 1);
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

    /**
     * Sends new comment notification to the author. Will only send emails when configured to do it.
     *
     * @param Model_Comment $comment the new comment
     */
    public function sendNewCommentToAuthor(Model_Comment $comment)
    {
        if (!$this->_config['send_email']['to_author']) {
            return;
        }

        $parent_item = $comment->getRelatedItem();
        try {
            $author = $parent_item->created_by;
        } catch (\Exception $e) {
            // No Behaviour_Author
            return;
        }

        // Retrieve strings in the lang of the author
        \Nos\I18n::setLocale($author->user_lang);
        $dictionary = \Nos\I18n::dictionary('noviusos_comments::common');

        $mail = \Email::forge();
        $mail->to($author->user_email);
        // Note to translator: This is an email’s subject
        $mail->subject(strtr($dictionary('{{item_title}}: New comment'), array('{{item_title}}' => $parent_item->title_item())));
        $mail->html_body(\View::forge('noviusos_comments::email/admin', array('comment' => $comment, 'item' => $parent_item)));

        // Restore the locale for the connected user
        \Nos\I18n::restoreLocale($author->user_lang);

        try {
            $mail->send();
        } catch (\Exception $e) {
            logger(\Fuel::L_ERROR, 'The Comments application cannot send emails - '.$e->getMessage());
        }
    }

    /**
     * Sends new comment notification to the commenters. Will only send emails when configured to do it.
     *
     * @param  $comment Model_Comment
     * @param  $item \Nos\Orm\Model
     */
    public function sendNewCommentToCommenters(Model_Comment $comment)
    {
        if (!$this->_config['send_email']['to_commenters']) {
            return;
        }
        if ($comment->comm_state != 'published') {
            return;
        }
        $parent_item = $comment->getRelatedItem();

        $emails = array();
        foreach ($parent_item->comments as $comment_item) {
            if ($comment_item->comm_subscribed && $comment_item->comm_email !== $comment->comm_email) {
                $emails[$comment_item->comm_email] = $comment_item->comm_author;
            }
        }

        $error = '';
        foreach ($emails as $email => $author) {
            $mail = \Email::forge();
            $mail->to($email, $author);
            $mail->subject(strtr(__('{{item_title}}: New comment'), array('{{item_title}}' => $parent_item->title_item())));
            $mail->html_body(\View::forge('noviusos_comments::email/commenters', array(
                'comment' => $comment,
                'item' => $parent_item,
                'email' => $email,
            )));

            try {
                $mail->send();
            } catch (\Exception $e) {
                if ($error !== $e->getMessage()) {
                    $error = $e->getMessage();
                    logger(\Fuel::L_ERROR, 'The Comments application cannot send emails - '.$error);
                }
            }
        }
    }

    /**
     * Get an rss item for a comment
     *
     * @param $comment
     * @return array|null a comment item if it is related to an item
     */
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

    /**
     * @param array $options options how to get rss items (model and optionally item)
     * @return \Nos\Tools_RSS rss feed
     * @throws \Nos\NotFoundException if item was not found
     */
    public function getRss($options = array())
    {
        $context = \Nos\Nos::main_controller()->getPage()->page_context;
        $rss = \Nos\Tools_RSS::forge(array(
            'link' => \Nos\Tools_Url::encodePath(\Nos\Nos::main_controller()->getUrl()),
            'language' => \Nos\Tools_Context::locale($context),
        ));

        $find_options = array(
            'order_by'              => array('comm_created_at' => 'DESC'),
            'where' => array(
                'comm_foreign_model' => $options['model'],
                'comm_state' => 'published',
                'comm_context' => $context,
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

    /**
     * Change an user subscription status to comments related to an item
     *
     * @param $from Item from
     * @param $email Email of the user
     * @param $subscribe
     */
    public function changeSubscriptionStatus($from, $email, $subscribe)
    {
        \Nos\Comments\Model_Comment::changeSubscriptionStatus($from, $email, $subscribe);
    }
}
