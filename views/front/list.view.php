<ul class="comments_list">
    <?php foreach($comments as $comment) { ?>
    <?= render('noviusos_blog::front/comment/item', array('comment' => $comment), true) ?>
    <?php } ?>
</ul>