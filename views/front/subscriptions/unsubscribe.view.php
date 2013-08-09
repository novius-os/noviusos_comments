<?php
\Nos\I18n::current_dictionary('noviusos_comments::common');
?>
<h2><?= __('OK, you won’t be notified any longer when new comments are posted.') ?></h2>
<p>
    <a href="<?= \Nos\Tools_Url::encodePath($item->url(array('subscribe' => true))).'?email='.urlencode($email) ?>"><?= __('I miscliked! I want to subscribe again.') ?></a>
</p>
