<?php
$states = array(
    'published'     => '<img src="static/novius-os/admin/novius-os/img/icons/status-green.png" />'.__('Published'),
    'pending'       => '<img src="static/novius-os/admin/novius-os/img/icons/status-orange.png" />'.__('Pending'),
    'refused'       => '<img src="static/novius-os/admin/novius-os/img/icons/status-red.png" />'.__('Refused'),
);

return array(
    'controller' => 'comment/crud',
    'data_mapping' => array(
        'comm_content' => array(
            'title' => __('Content'),
            'value' => function($item) {
                return Str::truncate($item->comm_content, 80);
            }
        ),
        'comm_email' => array(
            'title' => __('Email'),
        ),
        'comm_created_at' => array(
            'title' => __('Date'),
            'value' =>
            function ($item)
            {
                if ($item->is_new()) {
                    return null;
                }
                return \Date::create_from_string($item->comm_created_at, 'mysql')->format('%m/%d/%Y %H:%M:%S');
            },
        ),
        'comm_state' => array(
            'title' => __('State'),
            'value' =>
            function ($item) use ($states)
            {
                return $states[$item->comm_state];
            },
            'isSafeHtml' => true
        ),
        'preview_url' => array(
            'value' => function($item) {
                $url = $item->getRelatedItem()->url().'?_preview=1#comment_'.$item->comm_id;
                return $url;
            },
        )
    ),
    'actions' => array(
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
                    $url = $item->getRelatedItem()->url();
                    return $url == null;
                }),
            'targets' => array(
                'grid' => true,
                'toolbar-edit' => true,
            ),
        ),
    )
);