<?php

// Generated on 03/12/2013 16:22:23

// 35 out of 37 messages are translated (94%).
// 145 out of 153 words are translated (94%).

return array(
    #: classes/controller/admin/comment/crud.ctrl.php:39
    #: config/controller/admin/comment/crud.config.php:37
    #: config/common/comment.config.php:52
    'Deleted content' => 'Удаленное содержание',

    #: classes/api.php:157
    '{{item_title}}: New comment' => '{{item_title}}: Новый комметарий',

    #: classes/api.php:188
    'Comment to the post ‘{{post}}’.' => 'Комментарий к посту «{{post}}».',

    #: views/email/admin.view.php:7
    'Hello,

A new comment has just been posted for ‘{{item_title}}’:

{{comment}}

- Reply: {{visualise_link}}
- Moderate: {{moderation_link}}' => 'Здравствуйте!

Только что был опубликован комментарий к «{{item_title}}»:

{{comment}}

- Ответить: {{visualise_link}}
- Модерировать: {{moderation_link}}',

    #: views/email/commenters.view.php:7
    'Hello,

A new comment has just been posted for ‘{{item_title}}’. It might be a reply to your previous comment.

{{comment}}

- Reply: {{visualise_link}}
- Unsubscribe from this discussion: {{unsubscribe_link}}' => 'Проивет!

Новый комментарий только что добавлен к «{{item_title}}». Он может быть ответом на ваш предыдущий комментарий.

{{comment}}

- Ответить: {{visualise_link}}
- Отписаться от дискуссии: {{unsubscribe_link}}',

    #: config/controller/admin/comment/crud.config.php:15
    'Comment properties' => 'Свойства комментария',

    #: config/controller/admin/comment/crud.config.php:36
    #: config/controller/admin/comment/crud.config.php:54
    'Comment for ‘{{title}}’' => 'Комментарий к «{{title}}»',

    #: config/controller/admin/comment/crud.config.php:59
    'Author:' => 'Автор:',

    #: config/controller/admin/comment/crud.config.php:65
    'Author’s IP address:' => 'IP адрес автора:',

    #: config/controller/admin/comment/crud.config.php:70
    'Email address:' => 'Адрес эл. почты:',

    #: config/controller/admin/comment/crud.config.php:76
    'Sent on:' => 'Отправлено:',

    #: config/controller/admin/comment/crud.config.php:80
    'Status:' => 'Статус:',

    #: config/controller/admin/comment/crud.config.php:86
    #: config/common/comment.config.php:12
    'Refused' => 'Отказано',

    #: config/controller/admin/comment/crud.config.php:90
    #: config/common/comment.config.php:11
    'Pending' => 'Ожидает',

    #: config/controller/admin/comment/crud.config.php:94
    #: config/common/comment.config.php:10
    'Published' => 'Опубликовано',

    #: config/controller/admin/comment/crud.config.php:101
    'Comment:' => 'Комментарий:',

    #: config/controller/admin/comment/appdesk.config.php:17
    'comment' => 'комментарий',

    #: config/controller/admin/comment/appdesk.config.php:18
    'comments' => 'комментарии',

    #: config/controller/admin/comment/appdesk.config.php:20
    '1 comment' => array(
        0 => '',
        1 => '',
        2 => '{{count}} комментариев',
    ),

    #: config/controller/admin/comment/appdesk.config.php:24
    'Showing 1 comment out of {{y}}' => array(
        0 => '',
        1 => '',
        2 => 'Показано комментариев: {{x}} из {{y}}',
    ),

    #: config/controller/admin/comment/appdesk.config.php:27
    'No comments' => 'Нет комментариев',

    #: config/controller/admin/comment/appdesk.config.php:28
    'Showing all comments' => 'Показаны все комментарии',

    #: config/controller/admin/comment/appdesk.config.php:37
    'You have a problem here: Your Novius OS is not set up to send emails. You’ll have to ask your developer to set it up for you.' => 'Возникла проблема, ваша Novius OS не была настроена для отправки писем. Обратитесь к вашему разработчику, чтобы он настроил ее для вас.',

    #: config/controller/admin/comment/appdesk.config.php:48
    #: config/orm/behaviour/commentable.config.php:20
    #: config/orm/behaviour/commentable.config.php:59
    'Comments for ‘{{title}}’' => 'Комментарии к «{{title}}»',

    #: config/orm/behaviour/commentable.config.php:8
    #: config/orm/behaviour/commentable.config.php:49
    'Comments' => 'Комментарии',

    #: config/orm/behaviour/commentable.config.php:77
    'This item has no comments.' => 'К этому элементу нет комментариев.',

    #: config/common/comment.config.php:19
    'Comment' => 'Комментарий',

    #: config/common/comment.config.php:46
    'Posted for' => 'Опубликовано для',

    #: config/common/comment.config.php:74
    'Email address' => 'Адрес эл. почты',

    #: config/common/comment.config.php:77
    'Status' => 'Статус',

    #: config/common/comment.config.php:94
    'Date' => 'Дата',

    #. Crud
    #: config/common/comment.config.php:112
    'The comment has been deleted.' => 'Комментарий был успешно удален.',

    #. General errors
    #: config/common/comment.config.php:115
    'This comment doesn’t exist any more. It has been deleted.' => 'Комментарий больше не существует. Он был удален.',

    #: config/common/comment.config.php:116
    'We cannot find this comment.' => 'Невозможно найти этот комментарий.',

    #. Deletion popup
    #: config/common/comment.config.php:119
    'Deleting the comment ‘{{title}}’' => 'Удаление комментария «{{title}}»',

    #: config/common/comment.config.php:123
    'Yes, delete this comment' => array(
        0 => 'Да, я хочу удалить этот комментарий',
        1 => '',
        2 => '',
    ),

    #: config/common/comment.config.php:131
    'Visualise' => 'Просмотреть',

);
