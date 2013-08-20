<?php

\Nos\I18n::current_dictionary('noviusos_comments::common');

$class = get_class($from_item);

$api_config = $from_item::commentApi()->getConfig();
$use_recaptcha = $api_config['use_recaptcha'];
$anti_spam_identifier_failed = \Security::htmlspecialchars($api_config['anti_spam_identifier']['failed']);
$anti_spam_identifier_passed = json_encode($api_config['anti_spam_identifier']['passed']);

Nos\I18n::current_dictionary('noviusos_comments::front');
?>
<div class="comment_form" id="comment_form">
    <form class="comment_form" name="TheFormComment" id="TheFormComment" method="post">
        <input type="hidden" name="model" value="<?= $class ?>" />
        <input type="hidden" name="id" value="<?= $from_item->id ?>" />
        <input type="hidden" name="action" value="addComment" />
        <input class="input_mm" type="hidden" id="<?= $uniqid_mm = uniqid('mm_'); ?>" name="ismm" value="<?= $anti_spam_identifier_failed ?>">
        <div class="comment_form_title"><?= __('Leave a comment') ?></div>
        <?= \Nos\FrontCache::viewForgeUncached('noviusos_comments::front/add_comment_message') ?>
        <table border="0">
            <tbody>
            <tr>
                <td align="right"><label for="comm_author"><?= __('Name:') ?></label></td>
                <td><input type="text" style="width:300px;" maxlength="100" id="comm_author" name="comm_author" value="<?= \Nos\FrontCache::viewForgeUncached('noviusos_comments::front/author') ?>"></td>
            </tr>
            <tr>
                <td align="right" valign="top"><label for="comm_email"><?= __('Email address (never sold, shared nor spammed):') ?></label></td>
                <td>
                    <input type="text" style="width:300px;" maxlength="100" id="comm_email" name="comm_email" value="<?= \Nos\FrontCache::viewForgeUncached('noviusos_comments::front/email') ?>">
                    <div>
                        <input type="checkbox" name="subscribe_to_comments" id="subscribe_to_comments" value="1" checked/>
                        <label for="subscribe_to_comments"><?= e(__('Receive new comments by email')) ?></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><label for="comm_content"><?= __('Your comment:') ?></label></td>
            </tr>
            <tr>
                <td colspan="2"><textarea style="width:100%;height:200px;" id="comm_content" name="comm_content"><?= \Nos\FrontCache::viewForgeUncached('noviusos_comments::front/content') ?></textarea></td>
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
            document.getElementById('<?= $uniqid_mm ?>').value = <?= $anti_spam_identifier_passed ?>;
            document.removeEventListener('mousemove', arguments.callee, false);
        }, false);
    } else {
        // Old IE
        document.attachEvent('onmousemove', function() {
            document.getElementById('<?= $uniqid_mm ?>').value = <?= $anti_spam_identifier_passed ?>;
            document.detachEvent('onmousemove', arguments.callee);
        });
    }
})();
</script>
