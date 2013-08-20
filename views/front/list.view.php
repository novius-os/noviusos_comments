<ul class="comments_list">
<?php
\Nos\I18n::current_dictionary('noviusos_comments::common');

foreach ($comments as $comment) {
    echo render('noviusos_comments::front/item', array('comment' => $comment, 'from_item' => $from_item), true);
}
?>
</ul>
