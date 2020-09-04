<?php
use yii\helpers\Url;
use common\components\FHtml;
use kartik\datecontrol\DateControl;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
    ],
    //[
    //    'class' => 'kartik\grid\SerialColumn',
    //    'width' => '30px',
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'id',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'transaction_id',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'user_id',
        'value' => function($model) { return FHtml::showAppUser($model->user_id); },
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'user_visible',
//        'hAlign'=>'center',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-1 nowrap'],
//    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'destination_id',
        'value' => function($model) { return FHtml::showAppUser($model->destination_id); },
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'destination_visible',
//        'hAlign'=>'center',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-1 nowrap'],
//    ],
    // [
    //     'class'=>'kartik\grid\DataColumn',
    //     'attribute'=>'object_id',
    //     'hAlign'=>'left',
    //     'vAlign'=>'middle',
    //     'contentOptions'=>['class'=>'col-md-2 nowrap'],
    // ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'object_type',
        'value' => function ($data) {
            return FHtml::showLabel($data->object_type, $data->object_type);
        },
        'format' => 'html',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'amount',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'currency',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'payment_method',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'note',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'time',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'action',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'type',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
//    [
//        'class'=>'kartik\grid\BooleanColumn',
//        'attribute'=>'is_active',
//        'hAlign'=>'center',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-1 nowrap'],
//    ],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'created_date',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'created_user',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'modified_date',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'modified_user',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'template' => '{view}{delete}',
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('common', 'title.view'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>$this->params['displayType'],'title'=>Yii::t('common', 'title.update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>[
            'role'=>'modal-remote',
            'title'=>Yii::t('common', 'title.delete'),
            'data-confirm'=>false,
            'data-method'=>false,// for overide yii data api
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Are you sure?',
            'data-confirm-message'=>'Are you sure want to delete this item'
        ],
    ],
];