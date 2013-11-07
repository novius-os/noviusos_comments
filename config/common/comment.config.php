<?php

\Nos\I18n::current_dictionary('noviusos_comments::common');


$model = \Input::get('model', null);
$id = \Input::get('id', null);
$item = null;

$states = array(
    'published'     => '<img src="static/novius-os/admin/novius-os/img/icons/status-green.png" />'.__('Published'),
    'pending'       => '<img src="static/apps/noviusos_comments/img/status-orange.png" />'.__('Pending'),
    'refused'       => '<img src="static/novius-os/admin/novius-os/img/icons/status-red.png" />'.__('Refused'),
);

$ret = array(
    'controller' => 'comment/crud',
    'data_mapping' => array(
        'comm_content' => array(
            'title' => __('Comment'),
            'value' => function ($item) {
                return Str::truncate($item->comm_content, 80);
            },
            'cellFormatters' => array(
                'link' => array(
                    'type' => 'link',
                    'action' => 'Nos\Comments\Model_Comment.edit'
                ),
            ),
        ),
        'item_deleted' => array(
            'value' => function ($item) {
                $relatedItem = $item->getRelatedItem();
                return empty($relatedItem) ? '1' : '0';
            },
        ),
        'item_icon' => array(
            'value' => function ($item) {
                $relatedItem = $item->getRelatedItem();
                if (!empty($relatedItem)) {
                    $model = get_class($relatedItem);
                    return \Config::icon($model, 16);
                }
            }
        ),
        'comm_from' => array(
            'title' => __('Posted for'),
            'value' => function ($item) {
                $relatedItem = $item->getRelatedItem();
                if (!empty($relatedItem)) {
                    return $relatedItem->title_item();
                }
                return __('Deleted content');
            },
            'cellFormatters' => array(
                'link' => array(
                    'ignore' => '{{item_deleted}}',
                    'type' => 'link',
                    'action' => array(
                        'action' => 'nosTabs',
                        'tab' => array(
                            'url' => '{{item_preview_url}}',
                        ),
                    ),
                ),
                'icon' => array(
                    'ignore' => '{{item_deleted}}',
                    'type' => 'icon',
                    'column' => 'item_icon',
                    'size' => 16,
                ),
            ),
        ),
        'comm_email' => array(
            'title' => __('Email address'),
        ),
        'comm_state' => array(
            'title' => __('Status'),
            'value' =>
            function ($item) use ($states) {
                return $states[$item->comm_state];
            },
            'isSafeHtml' => true
        ),
        'item_preview_url' => array(
            'value' => function ($item) {
                $relatedItem = $item->getRelatedItem();
                if (!empty($relatedItem)) {
                    $config = \Nos\Config_Common::load(get_class($relatedItem));
                    return $config['placeholders']['controller_base_url'].'insert_update/'.$relatedItem->id;
                }
            }
        ),
        'comm_created_at' => array(
            'title' => __('Date'),
            'value' => function ($item) {
                return \Date::create_from_string($item->comm_created_at, 'mysql')->wijmoFormat();
            },
            'dataType' => 'datetime',
            'dataFormatString' => 'f',
        ),
        'preview_url' => array(
            'value' => function ($item) {
                $relatedItem = $item->getRelatedItem();
                if (!empty($relatedItem)) {
                    return $relatedItem->preview_url().'#comment_'.$item->comm_id;
                }
            },
        )
    ),
    'i18n' => array(
        // Crud
        'notification item deleted' => __('The comment has been deleted.'),

        // General errors
        'notification item does not exist anymore' => __('This comment doesn’t exist any more. It has been deleted.'),
        'notification item not found' => __('We cannot find this comment.'),

        // Deletion popup
        'deleting item title' => __('Deleting the comment ‘{{title}}’'),

        # Delete action's labels
        'deleting button N items' => n__(
            'Yes, delete this comment',
            'Yes, delete these {{count}} comments'
        ),
    ),
    'actions' => array(
        'list' => array(
            'add' => false,
            'visualise' => array(
                'label' => __('Visualise'),
                'primary' => true,
                'iconClasses' => 'nos-icon16 nos-icon16-eye',
                'action' => array(
                    'action' => 'window.open',
                    'url' => '{{preview_url}}',
                ),
                'disabled' => array(
                    function ($item, $params) {
                        $relatedItem = $item->getRelatedItem();
                        if (!empty($relatedItem)) {
                            return $item->getRelatedItem()->preview_url();
                        }
                        return true;
                    }),
                'targets' => array(
                    'grid' => true,
                    'toolbar-edit' => true,
                ),
            ),
        ),
        'order' => array(
            'edit',
            'visualise',
            'delete',
        ),
    ),
);

if ($id !== null) {
    unset($ret['data_mapping']['comm_from']);
}

return $ret;
