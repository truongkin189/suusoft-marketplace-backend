<?php
use backend\modules\app\models\AppUserTransactionRequest;
use yii\helpers\Url;
use common\components\FHtml;

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
        'attribute'=>'user_id',
        'value' => function($model) { return FHtml::showAppUser($model->user_id); },
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'destination_id',
//        'value' => function($model) { return FHtml::showAppUser($model->destination_id); },
//        'hAlign'=>'left',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-2 nowrap'],
//    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'amount',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'type',
//        'filter' => array( 'exchange' => 'Exchange' , 'redeem' => 'Redeem', 'transfer' =>'Transfer'),
//        'hAlign'=>'left',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-2 nowrap'],
//    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'note',
//        'hAlign'=>'left',
//        'vAlign'=>'middle',
//        'contentOptions'=>['class'=>'col-md-2 nowrap'],
//    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'status',
        'value' => function ($data) {
            return FHtml::showLabel($data->status, AppUserTransactionRequest::getLabel($data->status));
        },
        'format' => 'html',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'filter' => array( 0 => 'Pending' , 1 => 'Approved', -1 =>'Rejected'),
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
//    [
//        'class'=>'kartik\grid\DataColumn',
//        'attribute'=>'time',
//        'value' => function ($data) {
//            return FHtml::showDateTime($data->time);
//        },
//        'hAlign'=>'left',
//        'vAlign'=>'middle',
//        'filter' => false,
//        'contentOptions'=>['class'=>'col-md-2 nowrap'],
//    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'created_date',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'modified_date',
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
            'role' => 'modal-remote',
            'title'=> Yii::t('common', 'title.delete'),
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item'
        ],
    ],
];