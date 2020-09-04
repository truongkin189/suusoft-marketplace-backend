<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Order */
?>
<?php if (!Yii::$app->request->isAjax) {
$this->title = 'Order';
$this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => 'index'];
$this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
$this->params['toolBarActions'] = array(
'linkButton'=>array(),
'button'=>array(),
'dropdown'=>array(),
);
$this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
<div class="app-user-view">

       <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                    'id',
                // 'billingName',
                // 'billingPhone',
                // 'billingAddress',
                // 'billingEmail:email',
                // 'billingPostcode',
                'shippingName',
                'shippingPhone',
                'shippingAddress',
                // 'shippingEmail:email',
                // 'shippingPostcode',
                'paymentMethod',
                // 'content:ntext',
                'status',
                // 'status_user',
                'total',
                // 'vat',
                'transportFee',
                'transportDes',
                'transportType',
                // 'user_id',
                // 'type_product',
                // 'token_payment',
                'createDate',
    ],
    ]) ?>
</div>
<?php } else { ?>
<div class="<?= $this->params['portletStyle'] ?>">
    <div class="portlet-title">
        <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php  echo $this->params['mainIcon'] ?>"></i>
                    <?= 'Order'?>
</span>
            <span class="caption-helper"><?=  Yii::t('common', 'title.view') ?>
</span>
        </div>
        <div class="tools">
            <a href="#" class="collapse"></a>
            <a href="#" class="fullscreen"></a>
        </div>
        <div class="actions">
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                            'id',
                        //    'billingName',
                        //    'billingPhone',
                        //    'billingAddress',
                        //    'billingEmail:email',
                        //    'billingPostcode',
                           'shippingName',
                           'shippingPhone',
                           'shippingAddress',
                        //    'shippingEmail:email',
                        //    'shippingPostcode',
                           'paymentMethod',
                        //    'content:ntext',
                           'status',
                        //    'status_user',
                           'total',
                        //    'vat',
                           'transportFee',
                           'transportDes',
                           'transportType',
                        //    'user_id',
                        //    'type_product',
                        //    'token_payment',
                           'createDate',
                ],
                ]) ?>
                <p>
                    <!--<?=  Html::a( Yii::t('common', 'button.update'), ['update', 'id' => $model->id],
                    ['class' => 'btn btn-primary']) ?>-->
                    <!-- <?=  Html::a( Yii::t('common', 'button.delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                    'confirm' => 'Are you sure you want to delete this item ?',
                    'method' => 'post',
                    ],
                    ]) ?> -->
                    <?=  Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn
                    btn-default']) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
                <div class="col-md-12">
                    <div id="ajaxCrudDatatable">
                        <?=GridView::widget([
                        'id'=>'crud-datatable',
                        //'floatHeader' => true, // enable this will keep header when scroll but disable resizeable column feature
                        'dataProvider' => $dataProvider,
                       // 'filterModel' => $searchModel,
                        'pjax' => true,
                        'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        ],
                       // 'toolbar' => require(__DIR__ . '/_toolbar.php'),
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            //'orderId',
                            'productId',
                            'productName',
                            'color',
                            'size',

                            'quantity',
                            'price',
                            'subTotal',
                           // ['class' => 'yii\grid\ActionColumn'],
                         ],
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'layout' => "{toolbar}\n{items}\n{summary}\n{pager}",
                        'panel' => false
                        ])?>
                    </div>
                </div>
            </div>

<?php } ?>
