<?php
$api_config = $from_item::commentApi()->getConfig();

Nos\I18n::current_dictionary('noviusos_comments::front');
?>
<li class="comment" id="comment_<?= $comment->comm_id ?>">
    <div class="comment_image">
        <img src="<?= htmlspecialchars(\Nos\Comments\Gravatar::url($comment->comm_email, $api_config['gravatar'])) ?>" width="<?= $api_config['gravatar']['size'] ?>" height="<?= $api_config['gravatar']['size'] ?>">
    </div>
    <div class="comment_infos">
        <span class="comment_author"><?= e(strtr(__('Comment by {{author}}'), array('{{author}}' => $comment->comm_author))) ?></span>
        <span class="comment_date"><?= e(Date::forge(strtotime($comment->comm_created_at))->format(__('%d/%m/%Y at %H:%M'))) ?></span>
        <br class="clearfloat">
    </div>
    <div class="comment_content">
        <?= Str::textToHtml(e($comment->comm_content)) ?>
    </div>
</li>
