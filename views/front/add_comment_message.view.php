<?php

\Nos\I18n::current_dictionary('noviusos_comments::common');

$add_comment_success = \Session::get_flash('noviusos_comment::add_comment_success', 'none');
if (isset($add_comment_success)) {
    if ($add_comment_success === false) {
        ?>
        <div class="error">
            <?= __('You failed the captcha test. Please try again.') ?>
        </div>
    <?php
    } elseif ($add_comment_success === true) {
        ?>
        <div class="success">
            <?= __('Your comment has been successfully added.') ?>
        </div>
    <?php
    }
}
