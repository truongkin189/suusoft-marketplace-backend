<?php
use yii\helpers\Url;
use common\components\FHtml;
use kartik\datecontrol\DateControl;

use backend\modules\app\models\invitecode\AppUserInviteCode;

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
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'format' => 'html',
        'value' => function($model) {
            return FHtml::showCategory(AppUserInviteCode::getUserInvited($model->user_id));
        },
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'invite_code',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-3 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'status',
        'format' => 'html',
        'value' => function ($data) {
            return FHtml::showLabel($data->status, AppUserInviteCode::getStatusLabel($data->status));
        },
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    // [
    //     'class'=>'kartik\grid\DataColumn',
    //     'attribute'=>'created_at',
    //     'hAlign'=>'left',
    //     'vAlign'=>'middle',
    //     'contentOptions'=>['class'=>'col-md-2 nowrap'],
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view}',
        'urlCreator' => function($action, $model) {
            return Url::to([$action, 'id' => $model->id]);
        },
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