<?php
namespace Nos\Comments;

class Controller_Admin_Comment_Crud extends \Nos\Controller_Admin_Crud
{
    protected $sendEmailNotification = false;

    public function before_save($item, $data)
    {
        $this->sendEmailNotification = $item->is_changed('comm_state') && $item->comm_state == 'published';
        return parent::before_save($item, $data);
    }

    public function save($item, $data)
    {
        // @todo make Comment contextable
        /*
        if ($this->sendEmailNotification) {
            $relatedItem = $api = $item->getRelatedItem();
            if (!empty($relatedItem)) {
                $api = $relatedItem->commentApi();
                $api->sendNewCommentToAuthor($item);
                $api->sendNewCommentToCommenters($item);
            }
        }*/
        return parent::save($item, $data);
    }
}
