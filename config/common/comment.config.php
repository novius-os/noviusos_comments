<?php
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
            'value' => function($item) {
                return Str::truncate($item->comm_content, 80);
            },
            'cellFormatters' => array(
                'link' => array(
                    'type' => 'link',
                    'action' => 'Nos\Comments\Model_Comment.edit'
                ),
            ),
        ),
        'comm_from' => array(
            'title' => __('Posted for'),
            'value' => function ($item) {
                $relatedItem = $item->getRelatedItem();
                $model = get_class($relatedItem);
                return '<img src="'.\Config::icon($model, 16).'" style="vertical-align: middle; margin-right: 3px;"><span>'.e($relatedItem->title).'</span>';
            },
            'isSafeHtml' => true,
            'cellFormatters' => array(
                'link' => array(
                    'type' => 'link',
                    'action' => array(
                        'action' => 'nosTabs',
                        'tab' => array(
                            'url' => '{{comm_preview_url}}',
                        ),
                    ),
                ),
            ),
        ),
        'comm_email' => array(
            'title' => __('Email address'),
        ),
        'comm_state' => array(
            'title' => __('Status'),
            'value' =>
            function ($item) use ($states)
            {
                return $states[$item->comm_state];
            },
            'isSafeHtml' => true
        ),
        'comm_preview_url' => array(
            'value' => function($item) {
                $relatedItem = $item->getRelatedItem();
                $config = \Nos\Config_Common::load(get_class($relatedItem));
                return $config['placeholders']['controller_base_url'].'insert_update/'.$relatedItem->id;
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
            'value' => function($item) {
                $url = $item->getRelatedItem()->preview_url().'#comment_'.$item->comm_id;
                return $url;
            },
        )
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
                    function($item, $params)
                    {
                        $url = $item->getRelatedItem()->preview_url();
                        return $url == null;
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