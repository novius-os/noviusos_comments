<?php

// Generated on 07/07/2014 11:51:57

// 37 out of 37 messages are translated (100%).
// 153 out of 153 words are translated (100%).

return array(
    #: config/controller/admin/comment/crud.config.php:15
    'Comment properties' => 'Propriétés du commentaire',

    #: config/controller/admin/comment/crud.config.php:36
    #: config/controller/admin/comment/crud.config.php:54
    'Comment for ‘{{title}}’' => 'Commentaire pour «&nbsp;{{title}}&nbsp;»',

    #: config/controller/admin/comment/crud.config.php:37
    #: config/common/comment.config.php:52
    #: classes/controller/admin/comment/crud.ctrl.php:39
    'Deleted content' => 'Contenu supprimé',

    #: config/controller/admin/comment/crud.config.php:59
    'Author:' => 'Auteur&nbsp;:',

    #: config/controller/admin/comment/crud.config.php:65
    'Author’s IP address:' => 'Adresse IP de l’auteur&nbsp;:',

    #: config/controller/admin/comment/crud.config.php:70
    'Email address:' => 'Adresse email&nbsp;:',

    #: config/controller/admin/comment/crud.config.php:76
    'Sent on:' => 'Envoyé le&nbsp;:',

    #: config/controller/admin/comment/crud.config.php:80
    'Status:' => 'État&nbsp;:',

    #: config/controller/admin/comment/crud.config.php:86
    #: config/common/comment.config.php:12
    'Refused' => 'Refusé',

    #: config/controller/admin/comment/crud.config.php:90
    #: config/common/comment.config.php:11
    'Pending' => 'En attente',

    #: config/controller/admin/comment/crud.config.php:94
    #: config/common/comment.config.php:10
    'Published' => 'Publié',

    #: config/controller/admin/comment/crud.config.php:101
    'Comment:' => 'Commentaire&nbsp;:',

    #: config/controller/admin/comment/appdesk.config.php:17
    'comment' => 'commentaire',

    #: config/controller/admin/comment/appdesk.config.php:18
    'comments' => 'commentaires',

    #: config/controller/admin/comment/appdesk.config.php:20
    '1 comment' => array(
        0 => '1 commentaire',
        1 => '{{count}} commentaires',
    ),

    #: config/controller/admin/comment/appdesk.config.php:24
    'Showing 1 comment out of {{y}}' => array(
        0 => '1 commentaire sur {{y}} affiché',
        1 => '{{x}} commentaires sur {{y}} affichés',
    ),

    #: config/controller/admin/comment/appdesk.config.php:27
    'No comments' => 'Pas de commentaire',

    #: config/controller/admin/comment/appdesk.config.php:28
    'Showing all comments' => 'Afficher tous les commentaires',

    #: config/controller/admin/comment/appdesk.config.php:37
    'You have a problem here: Your Novius OS is not set up to send emails. You’ll have to ask your developer to set it up for you.' => 'Il y a un souci&nbsp;: Votre Novius OS n’est pas configuré pour envoyer des emails. Demandez à votre développeur de le configurer.',

    #: config/controller/admin/comment/appdesk.config.php:48
    #: config/orm/behaviour/commentable.config.php:20
    #: config/orm/behaviour/commentable.config.php:58
    'Comments for ‘{{title}}’' => 'Commentaires pour «&nbsp;{{title}}&nbsp;»',

    #: config/common/comment.config.php:19
    'Comment' => 'Commentaire',

    #: config/common/comment.config.php:46
    'Posted for' => 'Publié pour',

    #: config/common/comment.config.php:74
    'Email address' => 'Adresse email',

    #: config/common/comment.config.php:77
    'Status' => 'État',

    #: config/common/comment.config.php:94
    'Date' => 'Date',

    #. Crud
    #: config/common/comment.config.php:112
    'The comment has been deleted.' => 'Le commentaire a été supprimé.',

    #. General errors
    #: config/common/comment.config.php:115
    'This comment doesn’t exist any more. It has been deleted.' => 'Ce commentaire n’existe plus. Il a été supprimé.',

    #: config/common/comment.config.php:116
    'We cannot find this comment.' => 'Nous n’arrivons pas à trouver ce commentaire.',

    #. Deletion popup
    #: config/common/comment.config.php:119
    'Deleting the comment ‘{{title}}’' => 'Supprimer le commentaire «&nbsp;{{title}}&nbsp;»',

    #: config/common/comment.config.php:123
    'Yes, delete this comment' => array(
        0 => 'Oui, supprimer ce commentaire',
        1 => 'Oui, supprimer ces {{count}} commentaires',
    ),

    #: config/common/comment.config.php:131
    'Visualise' => 'Visualiser',

    #: config/orm/behaviour/commentable.config.php:8
    #: config/orm/behaviour/commentable.config.php:48
    'Comments' => 'Commentaires',

    #: config/orm/behaviour/commentable.config.php:76
    'This item has no comments.' => 'Cet item n’a pas de commentaire.',

    #: views/email/commenters.view.php:7
    'Hello,

A new comment has just been posted for ‘{{item_title}}’. It might be a reply to your previous comment.

{{comment}}

- Reply: {{visualise_link}}
- Unsubscribe from this discussion: {{unsubscribe_link}}' => 'Bonjour,

Un nouveau commentaire vient d’être publié pour «&nbsp;{{item_title}}&nbsp;». Il s’agit peut-être d’une réponse à votre commentaire.

{{comment}}

- Répondre&nbsp;: {{visualise_link}}
- Ne plus suivre cette discussion&nbsp;: {{unsubscribe_link}}',

    #: views/email/admin.view.php:7
    'Hello,

A new comment has just been posted for ‘{{item_title}}’:

{{comment}}

- Reply: {{visualise_link}}
- Moderate: {{moderation_link}}' => 'Bonjour,

Un nouveau commentaire vient d’être publié pour «&nbsp;{{item_title}}&nbsp;»&nbsp;:

{{comment}}

- Répondre&nbsp;: {{visualise_link}}
- Modérer&nbsp;: {{moderation_link}}',

    #: classes/api.php:157
    '{{item_title}}: New comment' => '{{item_title}} : Nouveau commentaire',

    #: classes/api.php:188
    'Comment to the post ‘{{post}}’.' => 'Commentaire du billlet «&nbsp;{{post}}&nbsp;».',

);
