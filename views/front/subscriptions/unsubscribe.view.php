<h2><?= __('OK, you won’t be notified any longer when new comments are posted.') ?></h2>
<p>
    <a href="<?= htmlspecialchars($item->url(array('subscribe' => true)).'?email='.$email) ?>"><?= __('I miscliked! I want to subscribe again.') ?></a>
</p>