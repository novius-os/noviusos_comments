<?php
return array(
    'controller_url'  => 'admin/noviusos_comments/comment/crud',
    'model' => 'Nos\Comments\Model_Comment',
    'layout' => array(
        'large' => true,
        'save' => 'save',
        //'title' => 'comm_content',
        'content' => array(
            'test' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => __('Comment properties'),
                    'nomargin' => true,
                    'options' => array(
                        'allowExpand' => false,
                    ),
                    'content' => array(
                        'view' => 'nos::form/fields',
                        'params' => array(
                            'fields' => array(
                                'comm_author', 'comm_ip', 'comm_email', 'comm_created_at', 'comm_state', 'comm_content'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'fields' => array(
        'comm_id' => array (
            'label' => 'ID: ',
            'form' => array(
                'type' => 'hidden',
            ),
            'dont_save' => true,
        ),
        'comm_author' => array(
            'label' => __('Author'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'comm_ip' => array(
            'label' => __('IP'),
            'renderer' => 'Nos\Renderer_Text',
            'editable' => false,
        ),
        'comm_email' => array(
            'label' => __('Email'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'comm_created_at' => array(
            'label' => __('Date'),
            'renderer' => '\Nos\Renderer_Datetime_Picker'
        ),
        'comm_state' => array(
            'label' => __('State'),
            'form' => array(
                'type' => 'select',
                'options' => array(
                    'published' => 'Published',
                    'pending' => 'Pending',
                    'refused' => 'Refused'
                )
            )
        ),
        'comm_content' => array(
            'label' => __('Content'),
            'form' => array(
                'type' => 'textarea',
                'rows' => 15
            ),
        ),
        'save' => array(
            'label' => '',
            'form' => array(
                'type' => 'submit',
                'tag' => 'button',
                // Note to translator: This is a submit button
                'value' => __('Save'),
                'class' => 'primary',
                'data-icon' => 'check',
            ),
        ),
    )
    /* UI texts sample
    'messages' => array(
        'successfully added' => __('Item successfully added.'),
        'successfully saved' => __('Item successfully saved.'),
        'successfully deleted' => __('Item has successfully been deleted!'),
        'you are about to delete, confim' => __('You are about to delete item <span style="font-weight: bold;">":title"</span>. Are you sure you want to continue?'),
        'you are about to delete' => __('You are about to delete item <span style="font-weight: bold;">":title"</span>.'),
        'exists in multiple context' => __('This item exists in <strong>{count} contexts</strong>.'),
        'delete in the following contexts' => __('Delete this item in the following contexts:'),
        'item deleted' => __('This item has been deleted.'),
        'not found' => __('Item not found'),
        'error added in context' => __('This item cannot be added {context}.'),
        'item inexistent in context yet' => __('This item has not been added in {context} yet.'),
        'add an item in context' => __('Add a new item in {context}'),
        'delete an item' => __('Delete a item'),
    ),
    */
    /*
    Tab configuration sample
    'tab' => array(
        'iconUrl' => 'static/apps/{{application_name}}/img/16/icon.png',
        'labels' => array(
            'insert' => __('Add a item'),
            'blankSlate' => __('Translate a item'),
        ),
    ),
    */
);