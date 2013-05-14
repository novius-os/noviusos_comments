<?php
return array(
    'controller_url'  => 'admin/noviusos_comments/comment/crud',
    'model' => 'Nos\Comments\Model_Comment',
    'layout' => array(
        'large' => true,
        'save' => 'save',
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
);