<?php
return array(
    'controller_url'  => 'admin/noviusos_comments/comment/crud',
    'model' => 'Nos\Comments\Model_Comment',
    'css' => array(
        'static/apps/noviusos_comments/css/admin.css'
    ),
    'layout' => array(
        'large' => true,
        'save' => 'save',
        'content' => array(
            'title' => array(
                'view' => 'noviusos_comments::admin/crud_title',
            ),
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
            'label' => __('Author:'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'comm_ip' => array(
            'label' => __('Author’s IP address:'),
            'renderer' => 'Nos\Renderer_Text',
            'editable' => false,
        ),
        'comm_email' => array(
            'label' => __('Email address:'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'comm_created_at' => array(
            'label' => __('Sent on:'),
            'renderer' => '\Nos\Renderer_Datetime_Picker'
        ),
        'comm_state' => array(
            'label' => __('Status:'),
            'renderer' => '\Nos\Renderer_Radioset',
            'renderer_options' => array(
                'choices' => array(
                    'refused' => array(
                        'label' => '<img src="static/novius-os/admin/novius-os/img/icons/status-red.png" />',
                        'side_label' => __('Refused'),
                    ),
                    'pending' => array(
                        'label' => '<img src="static/apps/noviusos_comments/img/status-orange.png" />',
                        'side_label' => __('Pending'),
                    ),
                    'published' => array(
                        'label' => '<img src="static/novius-os/admin/novius-os/img/icons/status-green.png" />',
                        'side_label' => __('Published'),
                    ),
                ),
                'class' => 'flat',
            ),
        ),
        'comm_content' => array(
            'label' => __('Comment:'),
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
                'class' => 'ui-priority-primary',
                'data-icon' => 'check',
            ),
        ),
    )
);
