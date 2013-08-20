<?php
\Nos\I18n::current_dictionary(array('noviusos_comments::common', 'nos::common'));
$relatedItem = $item->getRelatedItem();
?>
<h1 class="title comment_title">
    <?= strtr(__('Comment for ‘{{title}}’'), array('{{title}}' => !empty($relatedItem) ? $relatedItem->title_item() : __('The item has been deleted.'))) ?>
</h1>
