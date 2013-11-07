<?php

\Nos\I18n::current_dictionary('noviusos_comments::common');

$model = \Input::get('model', null);
$id = \Input::get('id', null);
$item = null;

if ($model !== null && $id !== null) {
    $item = $model::find($id);
}

$ret = array(
    'model' => 'Nos\Comments\Model_Comment',
    'search_text' => 'comm_content',
    'i18n' => array(
        'item' => __('comment'),
        'items' => __('comments'),
        'NItems' => n__(
            '1 comment',
            '{{count}} comments'
        ),
        'showNbItems' => n__(
            'Showing 1 comment out of {{y}}',
            'Showing {{x}} comments out of {{y}}'
        ),
        'showNoItem' => __('No comments'),
        'showAll' => __('Showing all comments'),
    ),
    'query' => array(
        'order_by' => array('comm_created_at' => 'DESC'),
    ),
);

if (!\Email::hasDefaultFrom()) {
    $ret['notify'] = array(
        'message' => __('You have a problem here: Your Novius OS is not set up to send emails. You’ll have to ask your developer to set it up for you.'),
        'type' => 'error',
    );
}

if ($item != null) {
    $ret['query']['callback'] = array(function ($query) use ($item) {
        $query->where(array(array('comm_foreign_model' => get_class($item), 'comm_foreign_id' => $item->id)));
        return $query;
    });

    $appdesk_label = strtr(__('Comments for ‘{{title}}’'), array('{{title}}' => $item->title_item()));

    $ret['i18n']['items'] = $appdesk_label;

    $ret['appdesk'] = array(
        'appdesk' => array(
            'grid' => array(
                'urlJson' => \Nos\Comments\Controller_Admin_Comment_Appdesk::get_path().'/json?model='.$model.'&id='.$id
            ),
        ),
        'tab' => array(
            'label' => $appdesk_label,
            'iconUrl' => \Config::icon('noviusos_comments', 16),
            'iconSize' => 16,
            'labelDisplay' => true,
        )
    );

}


return $ret;
