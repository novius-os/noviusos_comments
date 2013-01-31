<?php

Nos\I18n::current_dictionary('noviusos_comments::common');

$author =\Cookie::get('comm_author', '');
$email = \Cookie::get('comm_email', '');
$content = "";
?>
<div class="comment_form" id="comment_form">
    <form class="comment_form" name="TheFormComment" id="TheFormComment" method="post" action="<?= \Nos\Nos::main_controller()->getUrl() ?>#comment_form">
        <input type="hidden" name="todo" value="add_comment">
        <input class="input_mm" type="hidden" id="<?= $uniqid_mm = uniqid('mm_'); ?>" name="ismm" value="214">
        <div class="comment_form_title"><?= __('Leave a comment') ?></div>
<?php
if (isset($add_comment_success)) {
    if ($add_comment_success === false) {
        $author = \Input::post('comm_author');
        $email = \Input::post('comm_email');
        $content = \Input::post('comm_content');
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
?>
        <table border="0">
            <tbody>
            <tr>
                <td align="right"><label for="comm_author"><?= __('Name:') ?></label></td>
                <td><input type="text" style="width:300px;" maxlength="100" id="comm_author" name="comm_author" value="<?= e($author) ?>"></td>
            </tr>
            <tr>
                <td align="right"><label for="comm_email"><?= __('Email address (never sold, shared nor spammed):') ?></label></td>
                <td><input type="text" style="width:300px;" maxlength="100" id="comm_email" name="comm_email" value="<?= e($email) ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><label for="comm_content"><?= __('Your comment:') ?></label></td>
            </tr>
            <tr>
                <td colspan="2"><textarea style="width:100%;height:200px;" id="comm_content" name="comm_content"><?= e($content) ?></textarea></td>
            </tr>
            </tbody>
        </table>
        <script type="text/javascript">
            var RecaptchaOptions = {
                theme:'clean'
            };
        </script>
<?php
if ($use_recaptcha) {
    ?>
        <?= ReCaptcha::instance()->get_html() ?>
    <?php
}
?>
        <div class="comment_submit"><input type="submit" value="<?= __('Send') ?>"></div>
    </form>
</div>
<script type="text/javascript">
(function() {
    if (document.addEventListener) {
        document.addEventListener('mousemove', function() {
            document.getElementById('<?= $uniqid_mm ?>').value = 327;
            document.removeEventListener('mousemove', arguments.callee, false);
        }, false);
    } else {
        // Old IE
        document.attachEvent('onmousemove', function() {
            document.getElementById('<?= $uniqid_mm ?>').value = 327;
            document.detachEvent('onmousemove', arguments.callee);
        });
    }
})();
</script>
