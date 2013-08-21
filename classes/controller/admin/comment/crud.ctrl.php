<?php
namespace Nos\Comments;

class Controller_Admin_Comment_Crud extends \Nos\Controller_Admin_Crud
{
    protected $sendEmailNotificationToCommenters = false;

    public function prepare_i18n()
    {
        parent::prepare_i18n();
        \Nos\I18n::current_dictionary('noviusos_comments::common');
    }

    public function before_save($item, $data)
    {
        $this->sendEmailNotificationToCommenters = $item->is_changed('comm_state') && $item->comm_state == 'published';
        return parent::before_save($item, $data);
    }

    public function save($item, $data)
    {
        // The author of the item already received a notification when the comment was added
        if ($this->sendEmailNotificationToCommenters) {
            $relatedItem = $api = $item->getRelatedItem();
            if (!empty($relatedItem)) {
                $api = $relatedItem->commentApi($item->get_context());
                $api->sendNewCommentToCommenters($item);
            }
        }
        return parent::save($item, $data);
    }

    public function fields($fields)
    {
        $fields = parent::fields($fields);
        if (!empty($fields['html_title'])) {
            $relatedItem = $this->item->getRelatedItem();
            $fields['html_title']['form']['value'] = strtr($fields['html_title']['form']['value'], array(
                '{{title}}' => !empty($relatedItem) ? $relatedItem->title_item() : __('Deleted content'),
            ));
        }
        return $fields;
    }
}
