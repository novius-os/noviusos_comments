<?php
$msg = __("Hello,

A new comment has just been posted for ‘{{item_title}}’:

{{comment}}

- Reply: {{visualise_link}}
- Moderate: {{moderation_link}}");

echo nl2br(strtr($msg, array(
    '{{item_title}}' => e($item->title),
    '{{comment}}' => \Str::textToHtml(e($comment->comm_content)),
    '{{visualise_link}}' => \Nos\Tools_Url::encodePath($item->url()),
    '{{moderation_link}}' => \Uri::base().'admin?tab='.urlencode('admin/noviusos_comments/comment/crud/insert_update/'.$comment->id),
)));