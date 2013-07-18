<?php
$msg = __("Hello,

A new comment has just been posted for ‘{{item_title}}’. It might be a reply to your previous comment.

{{comment}}

- Reply: {{visualise_link}}
- Unsubscribe from this discussion: {{unsubscribe_link}}");

$unsubscribe_url = \Nos\Tools_Url::encodePath($item->url(array('unsubscribe' => true)));

echo strtr($msg, array(
    '{{item_title}}' => $item->title,
    '{{comment}}' => \Str::textToHtml(e($comment->comm_content)),
    '{{visualise_link}}' => \Nos\Tools_Url::encodePath($item->url()),
    '{{unsubscribe_link}}' => $unsubscribe_url.'?email='.urlencode($comment->comm_email)
));