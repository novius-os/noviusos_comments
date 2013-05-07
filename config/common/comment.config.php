<?php
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
                return \Date::create_from_string($item->comm_created_at, 'mysql')->format('%m/%d/%Y %H:%M:%S'); //%m/%d/%Y %H:%i:%s
            },
        ),
        'preview_url' => array(
            'value' => function($item) {
                $url = $item->getRelatedItem()->url().'?_preview=1#comment_'.$item->comm_id;
                return $url;
            }
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
    /*
    'i18n' => array(
        // Crud
        'notification item added' => __('Done! The item has been added.'),
        'notification item saved' => __('OK, all changes are saved.'),
        'notification item deleted' => __('The item has been deleted.'),

        // General errors
        'notification item does not exist anymore' => __('This item doesn’t exist any more. It has been deleted.'),
        'notification item not found' => __('We cannot find this item.'),
        'deleted popup title' => __('Bye bye'),
        'deleted popup close' => __('Close tab'),

        // see novius-os/framework/config/i18n_common.config.php
    ),
    */
    /*
    'actions' => array(
        'delete' => array(
            'action' => array( // ce qu'on envoi à nosAction
                'action' => 'confirmationDialog',
                    'dialog' => array(
                    'contentUrl' => '{{controller_base_url}}delete/{{_id}}',
                    'title' => 'Delete',
                ),
            ),
            'label' => __('Delete'),
            'primary' => true,
            'icon' => 'trash',
            'red' => true,
            'targets' => array(
                'grid' => true,
                'toolbar-edit' => true,
            ),
            'disabled' => function($item) {
                return false;
            },
            'visible' => function($params) {
                return !isset($params['item']) || !$params['item']->is_new();
            },
        ),
    )
    */
    /*
    'actions' => array(
        'list' => array(
            'delete' => array(
                'action' => array( // ce qu'on envoi à nosAction
                    'action' => 'confirmationDialog',
                    'dialog' => array(
                        'contentUrl' => '{{controller_base_url}}delete/{{_id}}',
                        'title' => 'Delete',
                    ),
                ),
                'label' => __('Delete'),
                'primary' => true,
                'icon' => 'trash',
                'red' => true,
                'targets' => array(
                'grid' => true,
                    'toolbar-edit' => true,
                ),
                'disabled' => function($item) {
                        return false;
                },
                'visible' => function($params) {
                        return !isset($params['item']) || !$params['item']->is_new();
                },
            ),
        ),
        'order' => array(
            'delete',
            // others
        ),
    )
    */
);