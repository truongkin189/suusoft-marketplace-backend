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
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'user_id',
        'value' => function($model) { return FHtml::showAppUser($model->user_id); },
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'driver_experience',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'driver_license',
        //'value' => function($model) { return FHtml::getFileURL($model->driver_license, 'transport-driver', BACKEND, ''); },
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'online_started',
//        'hAlign'=>'left',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-2 nowrap'],
//    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'online_duration',
//        'hAlign'=>'left',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-2 nowrap'],
//    ],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'fare',
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
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'is_delivery',
        //'hAlign'=>'center',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-1 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'is_online',
        //'hAlign'=>'center',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-1 nowrap'],
    //],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'is_active',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-1 nowrap'],
    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'created_date',
//        'hAlign'=>'left',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-2 nowrap'],
//    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'modified_date',
//        'hAlign'=>'left',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-2 nowrap'],
//    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model) {
            return Url::to([$action, 'id' => $model->user_id]);
        },
        'template' => '{view}{delete}',
        'viewOptions'=>['role'=>$this->params['displayType'],'title'=>Yii::t('common', 'title.view'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>$this->params['displayType'],'title'=>Yii::t('common', 'title.update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>[
            'role'=>'modal-remote',
            'title'=>Yii::t('common', 'title.delete'),
            'data-confirm'=>false,
            'data-method'=>false,
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Are you sure?',
            'data-confirm-message'=>'Are you sure want to delete this item'
        ],
    ],
];