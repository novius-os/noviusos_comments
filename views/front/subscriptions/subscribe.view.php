<h2><?= __('You will now be notified when new comments are posted.') ?></h2>
<p>
    <a href="<?= htmlspecialchars($item->url(array('unsubscribe' => true)).'?email='.$email) ?>"><?= __('Finally, I want to unsubscribe again.') ?></a>
</p>