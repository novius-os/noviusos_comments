<?php
$model = \Input::get('model', null);
$id = \Input::get('id', null);
$item = null;

if ($model !== null && $id !== null) {
    $item = $model::find($id);
}

$ret = array(
    'model' => 'Nos\Comments\Model_Comment',
    'search_text' => 'comm_content',
    'query' => array(
        'order_by' => 'comm_created_at'
    )
);

if ($item != null) {
    $ret['query']['callback'] = array(function($query) use ($item) {
        $query->where(array(array('comm_foreign_model' => get_class($item), 'comm_foreign_id' => $item->id)));
        return $query;
    });

    $appdesk_label = strtr(__('Comments of ‘{{title}}’'), array('{{title}}' => $item->title));

    $ret['i18n'] = array(
        'items' => $appdesk_label,
    );

    $ret['appdesk'] = array(
        'appdesk' => array(
            'grid' => array(
                'urlJson' => \Nos\Comments\Controller_Admin_Comment_Appdesk::get_path().'/json?model='.$model.'&id='.$id
            ),
            'tab' => array(
                'label' => $appdesk_label,
            )
        )
    );
}


return $ret;