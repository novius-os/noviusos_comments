<?php

// Generated on 30/07/2014 09:57:01

// 37 out of 37 messages are translated (100%).
// 153 out of 153 words are translated (100%).

return array(
    #: config/controller/admin/comment/crud.config.php:15
    'Comment properties' => 'コメントプロパティ',

    #: config/controller/admin/comment/crud.config.php:36
    #: config/controller/admin/comment/crud.config.php:54
    'Comment for ‘{{title}}’' => '‘{{title}}’へのコメント',

    #: config/controller/admin/comment/crud.config.php:37
    #: config/common/comment.config.php:52
    #: classes/controller/admin/comment/crud.ctrl.php:39
    'Deleted content' => '削除されたコンテンツ',

    #: config/controller/admin/comment/crud.config.php:59
    'Author:' => 'コメント作者: ',

    #: config/controller/admin/comment/crud.config.php:65
    'Author’s IP address:' => 'コメント作者の IP アドレス: ',

    #: config/controller/admin/comment/crud.config.php:70
    'Email address:' => 'メールアドレス: ',

    #: config/controller/admin/comment/crud.config.php:76
    'Sent on:' => '送信日時: ',

    #: config/controller/admin/comment/crud.config.php:80
    'Status:' => '状態: ',

    #: config/controller/admin/comment/crud.config.php:86
    #: config/common/comment.config.php:12
    'Refused' => '拒否',

    #: config/controller/admin/comment/crud.config.php:90
    #: config/common/comment.config.php:11
    'Pending' => '承認待ち',

    #: config/controller/admin/comment/crud.config.php:94
    #: config/common/comment.config.php:10
    'Published' => '公開',

    #: config/controller/admin/comment/crud.config.php:101
    'Comment:' => 'コメント: ',

    #: config/controller/admin/comment/appdesk.config.php:17
    'comment' => 'コメント',

    #: config/controller/admin/comment/appdesk.config.php:18
    'comments' => 'コメント',

    #: config/controller/admin/comment/appdesk.config.php:20
    '1 comment' => array(
        0 => '1件のコメント{{count}}件のコメント',
    ),

    #: config/controller/admin/comment/appdesk.config.php:24
    'Showing 1 comment out of {{y}}' => array(
        0 => '{{y}}件のコメントのうち、1件を表示しています。{{y}}件のコメントのうち、{{x}}件を表示しています。',
    ),

    #: config/controller/admin/comment/appdesk.config.php:27
    'No comments' => 'コメント無し',

    #: config/controller/admin/comment/appdesk.config.php:28
    'Showing all comments' => '全てのコメントを表示しています',

    #: config/controller/admin/comment/appdesk.config.php:37
    'You have a problem here: Your Novius OS is not set up to send emails. You’ll have to ask your developer to set it up for you.' => '問題が発生しました。現在、Novius OS はメールを送信するように設定されていません。開発者に連絡し、設定をお願いしてください。',

    #: config/controller/admin/comment/appdesk.config.php:48
    #: config/orm/behaviour/commentable.config.php:20
    #: config/orm/behaviour/commentable.config.php:58
    'Comments for ‘{{title}}’' => '‘{{title}}’へのコメント',

    #: config/common/comment.config.php:19
    'Comment' => 'コメント',

    #: config/common/comment.config.php:46
    'Posted for' => 'コメント先',

    #: config/common/comment.config.php:74
    'Email address' => 'メールアドレス',

    #: config/common/comment.config.php:77
    'Status' => '状態',

    #: config/common/comment.config.php:94
    'Date' => '日付',

    #. Crud
    #: config/common/comment.config.php:112
    'The comment has been deleted.' => 'コメントは削除されています。',

    #. General errors
    #: config/common/comment.config.php:115
    'This comment doesn’t exist any more. It has been deleted.' => 'このコメントは存在しません。削除されました。',

    #: config/common/comment.config.php:116
    'We cannot find this comment.' => 'コメントが見つかりません。',

    #. Deletion popup
    #: config/common/comment.config.php:119
    'Deleting the comment ‘{{title}}’' => 'コメント‘{{title}}’を削除しようとしています',

    #: config/common/comment.config.php:123
    'Yes, delete this comment' => array(
        0 => 'はい、このコメントを削除します。はい、これら{{count}}件のコメントを削除します。',
    ),

    #: config/common/comment.config.php:131
    'Visualise' => '閲覧',

    #: config/orm/behaviour/commentable.config.php:8
    #: config/orm/behaviour/commentable.config.php:48
    'Comments' => 'コメント',

    #: config/orm/behaviour/commentable.config.php:76
    'This item has no comments.' => 'このアイテムには、コメントがありません。',

    #: views/email/commenters.view.php:7
    'Hello,

A new comment has just been posted for ‘{{item_title}}’. It might be a reply to your previous comment.

{{comment}}

- Reply: {{visualise_link}}
- Unsubscribe from this discussion: {{unsubscribe_link}}' => 'こんにちは。

‘{{item_title}}’に新しいコメントが投稿されました。あなたのコメントへの返信かもしれません。

{{comment}}

- 返信する: {{visualise_link}}
- このスレッドの通知を受け取らない: {{unsubscribe_link}}',

    #: views/email/admin.view.php:7
    'Hello,

A new comment has just been posted for ‘{{item_title}}’:

{{comment}}

- Reply: {{visualise_link}}
- Moderate: {{moderation_link}}' => 'こんにちは。

‘{{item_title}}’に新しいコメントが投稿されました。

{{comment}}

- 返信する: {{visualise_link}}
- 承認する: {{moderation_link}}',

    #: classes/api.php:157
    '{{item_title}}: New comment' => '{{item_title}}: 新しいコメント',

    #: classes/api.php:188
    'Comment to the post ‘{{post}}’.' => '投稿‘{{post}}’へのコメント',

);
