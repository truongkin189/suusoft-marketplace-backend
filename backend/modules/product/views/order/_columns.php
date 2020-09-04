<?php
use yii\helpers\Url;
use common\components\FHtml;
use kartik\datecontrol\DateControl;

use backend\modules\product\models\Order;


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
        'attribute'=>'id',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'billingName',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'billingPhone',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    // [
    //     'class'=>'kartik\grid\DataColumn',
    //     'attribute'=>'billingAddress',
    //     'hAlign'=>'left',
    //     'vAlign'=>'middle',
    //     'contentOptions'=>['class'=>'col-md-2 nowrap'],
    // ],
    // [
    //     'class'=>'kartik\grid\DataColumn',
    //     'attribute'=>'billingEmail',
    //     'hAlign'=>'left',
    //     'vAlign'=>'middle',
    //     'contentOptions'=>['class'=>'col-md-2 nowrap'],
    // ],
    // [
    //     'class'=>'kartik\grid\DataColumn',
    //     'attribute'=>'billingPostcode',
    //     'hAlign'=>'left',
    //     'vAlign'=>'middle',
    //     'contentOptions'=>['class'=>'col-md-2 nowrap'],
    // ],
    // [
    //     'class'=>'kartik\grid\DataColumn',
    //     'attribute'=>'shippingName',
    //     'hAlign'=>'left',
    //     'vAlign'=>'middle',
    //     'contentOptions'=>['class'=>'col-md-2 nowrap'],
    // ],
    // [
    //     'class'=>'kartik\grid\DataColumn',
    //     'attribute'=>'shippingPhone',
    //     'hAlign'=>'left',
    //     'vAlign'=>'middle',
    //     'contentOptions'=>['class'=>'col-md-2 nowrap'],
    // ],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'shippingAddress',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'shippingEmail',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'shippingPostcode',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'paymentMethod',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'content',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'status',
        'format'=>'html',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'value' => function ($data) {
            return FHtml::showLabel($data->status, Order::getStatusLabel($data->status));
            // return Order::getStatusLabel($data->status);
        },
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'status_user',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    [
        'class'=>'kartik\grid\DataColumn',
        'attribute'=>'total',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'contentOptions'=>['class'=>'col-md-2 nowrap'],
    ],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'vat',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'transportFee',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'transportDes',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'transportType',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'user_id',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'type_product',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'token_payment',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    //[
        //'class'=>'kartik\grid\DataColumn',
        //'attribute'=>'createDate',
        //'hAlign'=>'left',
        //'vAlign'=>'middle',
        //'contentOptions'=>['class'=>'col-md-2 nowrap'],
    //],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view}',
        // chi co nut xem va xoa
        'urlCreator' => function($action, $model) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('common', 'title.view'),'data-toggle'=>'tooltip'],
        // 'updateOptions'=>['role'=>$this->params['displayType'],'title'=>Yii::t('common', 'title.update'), 'data-toggle'=>'tooltip'],

        'viewOptions'=>['role'=>$this->params['displayType'],'title'=>Yii::t('common', 'title.view'),'data-toggle'=>'tooltip'],
        // dan view ra ca trang k phai modal
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