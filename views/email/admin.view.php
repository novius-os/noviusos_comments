<?php
$msg = __("Hi,

You just received a comment for ‘{{item_title}}’.

{{comment}}

Answer and visualise: {{visualise_link}}
Moderation: {{moderation_link}}");

echo strtr($msg, array(
    '{{item_title}}' => $item->title,
    '{{comment}}' => \Str::textToHtml(e($comment->comm_content)),
    '{{visualise_link}}' => $item->url(),
    '{{moderation_link}}' => \Uri::base().'admin?tab='.urlencode('admin/noviusos_comments/comment/crud/insert_update/'.$comment->id),
));