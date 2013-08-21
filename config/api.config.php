<?php

return array(
    'default' => array(
        'default_state' => 'published',
        'use_recaptcha' => false,
        'anti_spam_identifier' => array(
            'failed' => '548',
            'passed' => '327',
        ),
        'rss' => array(
            'model' => array(
                'nb' => 20,
            ),
            'item' => array(
                'nb' => 20,
            ),
        ),
        'send_email' => array(
            'to_author' => true,
            'to_commenters' => true
        ),
        'gravatar' => array(
            'size' => 64
        ),
    ),

    'setups' => array(
    ),
);
