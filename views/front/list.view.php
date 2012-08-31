<ul class="comments_list">
    <?php foreach ($comments as $comment) { ?>
    <?= render('noviusos_comments::front/item', array('comment' => $comment), true) ?>
    <?php } ?>
</ul>
