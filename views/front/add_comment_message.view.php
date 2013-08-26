<?php

\Nos\I18n::current_dictionary('noviusos_comments::common');

$add_comment_success = \Session::get_flash('noviusos_comment::add_comment_success', 'none');
if ($add_comment_success != 'none') {
    if ($add_comment_success === false) {
        ?>
        <div class="error">
            <?= __('You failed the captcha test. Please try again.') ?>
        </div>
    <?php
    } else {
        ?>
        <div class="success">
            <?= $add_comment_success == 2 ? __('Your comment has been submitted and is now awaiting moderation.') : __('Your comment has been successfully added.') ?>
        </div>
    <?php
    }
}
