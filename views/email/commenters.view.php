<?php
$msg = __("Hi,

‘{{item_title}}’ just received a comment. It might be an answer to one of your comments.

{{comment}}

Answer: {{visualise_link}}");

echo strtr($msg, array(
    '{{item_title}}' => $item->title,
    '{{comment}}' => \Str::textToHtml(e($comment->comm_content)),
    '{{visualise_link}}' => $item->url(),
));