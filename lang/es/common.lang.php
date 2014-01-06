<?php

// Generated on 06/01/2014 15:07:24

// 37 out of 37 messages are translated (100%).
// 153 out of 153 words are translated (100%).

return array(
    #: classes/controller/admin/comment/crud.ctrl.php:39
    #: config/controller/admin/comment/crud.config.php:37
    #: config/common/comment.config.php:52
    'Deleted content' => 'Contenido borrado',

    #: classes/api.php:157
    '{{item_title}}: New comment' => '{{item_title}}: Nuevo comentario',

    #: classes/api.php:188
    'Comment to the post ‘{{post}}’.' => 'Comentario del artículo «{{post}}».',

    #: views/email/admin.view.php:7
    'Hello,

A new comment has just been posted for ‘{{item_title}}’:

{{comment}}

- Reply: {{visualise_link}}
- Moderate: {{moderation_link}}' => 'Hola:

Se acaba de publicar un nuevo comentario en «{{item_title}}»:

{{comment}}

- Responder: {{visualise_link}}
- Moderar: {{moderation_link}}',

    #: views/email/commenters.view.php:7
    'Hello,

A new comment has just been posted for ‘{{item_title}}’. It might be a reply to your previous comment.

{{comment}}

- Reply: {{visualise_link}}
- Unsubscribe from this discussion: {{unsubscribe_link}}' => 'Hola:,

Se acaba de publicar un nuevo comentario en «{{item_title}}». Puede que sea una respuesta al comentario anterior.

{{comment}}

- Responder: {{visualise_link}}
- Cancelar la suscripción a la conversación: {{unsubscribe_link}}',

    #: config/controller/admin/comment/crud.config.php:15
    'Comment properties' => 'Propiedades del comentario',

    #: config/controller/admin/comment/crud.config.php:36
    #: config/controller/admin/comment/crud.config.php:54
    'Comment for ‘{{title}}’' => 'Comentario en «{{title}}»',

    #: config/controller/admin/comment/crud.config.php:59
    'Author:' => 'Autor:',

    #: config/controller/admin/comment/crud.config.php:65
    'Author’s IP address:' => 'Dirección IP del autor:',

    #: config/controller/admin/comment/crud.config.php:70
    'Email address:' => 'Correo electrónico:',

    #: config/controller/admin/comment/crud.config.php:76
    'Sent on:' => 'Enviado el:',

    #: config/controller/admin/comment/crud.config.php:80
    'Status:' => 'Estado:',

    #: config/controller/admin/comment/crud.config.php:86
    #: config/common/comment.config.php:12
    'Refused' => 'Rechazado',

    #: config/controller/admin/comment/crud.config.php:90
    #: config/common/comment.config.php:11
    'Pending' => 'Pendiente',

    #: config/controller/admin/comment/crud.config.php:94
    #: config/common/comment.config.php:10
    'Published' => 'Publicado',

    #: config/controller/admin/comment/crud.config.php:101
    'Comment:' => 'Comentario:',

    #: config/controller/admin/comment/appdesk.config.php:17
    'comment' => 'comentario',

    #: config/controller/admin/comment/appdesk.config.php:18
    'comments' => 'comentarios',

    #: config/controller/admin/comment/appdesk.config.php:20
    '1 comment' => array(
        0 => '1 comentario',
        1 => '{{count}} comentarios',
    ),

    #: config/controller/admin/comment/appdesk.config.php:24
    'Showing 1 comment out of {{y}}' => array(
        0 => 'Se muestra 1 comentario de los {{y}}',
        1 => 'Se muestran {{x}} comentarios de los {{y}}',
    ),

    #: config/controller/admin/comment/appdesk.config.php:27
    'No comments' => 'No hay comentarios',

    #: config/controller/admin/comment/appdesk.config.php:28
    'Showing all comments' => 'Mostrar todos los comentarios',

    #: config/controller/admin/comment/appdesk.config.php:37
    'You have a problem here: Your Novius OS is not set up to send emails. You’ll have to ask your developer to set it up for you.' => 'Algo no funciona: no se ha configurado el envío de correos electrónicos en tu Novius OS. Pídele a tu desarrollador que te lo configure.',

    #: config/controller/admin/comment/appdesk.config.php:48
    #: config/orm/behaviour/commentable.config.php:20
    #: config/orm/behaviour/commentable.config.php:59
    'Comments for ‘{{title}}’' => 'Comentarios en «{{title}}»',

    #: config/orm/behaviour/commentable.config.php:8
    #: config/orm/behaviour/commentable.config.php:49
    'Comments' => 'Comentarios',

    #: config/orm/behaviour/commentable.config.php:77
    'This item has no comments.' => 'Este elemento no tiene comentarios.',

    #: config/common/comment.config.php:19
    'Comment' => 'Comentario',

    #: config/common/comment.config.php:46
    'Posted for' => 'Publicado en',

    #: config/common/comment.config.php:74
    'Email address' => 'Correo electrónico',

    #: config/common/comment.config.php:77
    'Status' => 'Estado',

    #: config/common/comment.config.php:94
    'Date' => 'Fecha',

    #. Crud
    #: config/common/comment.config.php:112
    'The comment has been deleted.' => 'Se ha eliminado el comentario.',

    #. General errors
    #: config/common/comment.config.php:115
    'This comment doesn’t exist any more. It has been deleted.' => 'Este comentario ya no existe. Se ha eliminado.',

    #: config/common/comment.config.php:116
    'We cannot find this comment.' => 'No encontramos este comentario.',

    #. Deletion popup
    #: config/common/comment.config.php:119
    'Deleting the comment ‘{{title}}’' => 'Eliminar el comentario «{{title}}»',

    #: config/common/comment.config.php:123
    'Yes, delete this comment' => array(
        0 => 'Sí que quiero eliminar este comentario',
        1 => 'Sí que quiero eliminar estos {{count}} comentarios',
    ),

    #: config/common/comment.config.php:131
    'Visualise' => 'Ver',

);
