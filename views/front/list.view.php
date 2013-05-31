<ul class="comments_list">
<?php
foreach ($comments as $comment) {
    echo render('noviusos_comments::front/item', array('comment' => $comment), true);
}
?>
</ul>
