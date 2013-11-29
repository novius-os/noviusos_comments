<?php

\Nos\I18n::current_dictionary('noviusos_comments::common');

// Note to translator: This is an email
$msg = __(
    "Hello,

A new comment has just been posted for ‘{{item_title}}’:

{{comment}}

- Reply: {{visualise_link}}
- Moderate: {{moderation_link}}"
);

$visualise_url = \Nos\Tools_Url::encodePath($item->url());
$moderation_url = \Uri::base().'admin?tab='.urlencode('admin/noviusos_comments/comment/crud/insert_update/'.$comment->id);

echo nl2br(strtr($msg, array(
    '{{item_title}}' => e($item->title_item()),
    '{{comment}}' => \Str::textToHtml(e($comment->comm_content)),
    '{{visualise_link}}' => '<a href="'.$visualise_url.'">'.$visualise_url.'</a>',
    '{{moderation_link}}' => '<a href="'.$moderation_url.'">'.$moderation_url.'</a>',
)));
