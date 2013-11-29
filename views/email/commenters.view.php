<?php

\Nos\I18n::current_dictionary('noviusos_comments::front');

// Note to translator: This is an email
$msg = __(
    "Hello,

A new comment has just been posted for ‘{{item_title}}’. It might be a reply to your previous comment.

{{comment}}

- Reply: {{visualise_link}}
- Unsubscribe from this discussion: {{unsubscribe_link}}"
);

$visualise_url = \Nos\Tools_Url::encodePath($item->url());
$unsubscribe_url = \Nos\Tools_Url::encodePath($item->url(array('unsubscribe' => true))).'?email='.urlencode($email);

echo nl2br(strtr($msg, array(
    '{{item_title}}' => e($item->title_item()),
    '{{comment}}' => \Str::textToHtml(e($comment->comm_content)),
    '{{visualise_link}}' => '<a href="'.$visualise_url.'">'.$visualise_url.'</a>',
    '{{unsubscribe_link}}' => '<a href="'.$unsubscribe_url.'">'.$unsubscribe_url.'</a>',
)));
