<?php
\Nos\I18n::current_dictionary('noviusos_comments::common');
?>
<h2><?= __('You will now be notified when new comments are posted.') ?></h2>
<p>
    <a href="<?= \Nos\Tools_Url::encodePath($item->url(array('unsubscribe' => true))).'?email='.urlencode($email) ?>"><?= __('Finally, I want to unsubscribe again.') ?></a>
</p>
