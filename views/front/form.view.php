<?php
$class = get_class($from_item);
$config = \Nos\Comments\API::getConfigurationFromModel($class);

if (!isset($add_comment_success)) {
    $add_comment_success = \Session::get_flash('noviusos_comment::add_comment_success', 'none');
}

$use_recaptcha = \Arr::get($config, 'use_recaptcha', false);

Nos\I18n::current_dictionary('noviusos_comments::front');

$author =\Cookie::get('comm_author', '');
$email = \Cookie::get('comm_email', '');
$content = "";
?>
<div class="comment_form" id="comment_form">
    <form class="comment_form" name="TheFormComment" id="TheFormComment" method="post">
        <input type="hidden" name="model" value="<?= $class ?>" />
        <input type="hidden" name="id" value="<?= $from_item->id ?>" />
        <input type="hidden" name="action" value="addComment" />
        <input class="input_mm" type="hidden" id="<?= $uniqid_mm = uniqid('mm_'); ?>" name="ismm" value="214">
        <div class="comment_form_title"><?= __('Leave a comment') ?></div>
<?php
if (isset($add_comment_success)) {
    if ($add_comment_success === false) {
        $author = \Session::get_flash('noviusos_comment::comm_author');
        $email = \Session::get_flash('noviusos_comment::comm_email');
        $content = \Session::get_flash('noviusos_comment::comm_content');
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
    \Package::load('fuel-recatpcha', APPPATH.'packages/fuel-recaptcha/');
    echo ReCaptcha::instance()->get_html();
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
