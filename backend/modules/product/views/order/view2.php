<?php

use backend\modules\app\models\AppUser;
use kartik\widgets\StarRating;
use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\AppUser */
?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'product';
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
    $this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
    $this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
    <div class="app-user-view">
        <?= DetailView::widget([
            'model' => $model,
            // 'attributes' => [
            //         'id',
            //                 'title',
            //                 // [
            //                 //     'attribute' => 'image',
            //                 //     'value' => FHtml::showImageThumbnail($model->image, 300, 'banner'),
            //                 //     'format' => 'html',
            //                 // ],
            //                 'url',
            //                 'content',
            //                 'position',                         
            //                 'created_date',
            // ],
        ]) ?>
    </div>
<?php } else { ?>
    <div class="<?= $this->params['portletStyle'] ?>">
        <div class="portlet-title">
            <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php echo $this->params['mainIcon'] ?>"></i>
                    <?= 'Chi tiết hoá đơn' ?>
</span>
                <span class="caption-helper"><?= Yii::t('common', 'title.view') ?>
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
                            'shippingName',
                            'shippingPhone',
                            'shippingAddress',   
                            'paymentMethod', 
                            'status', 
                            'total', 
                            'transportFee', 
                            'transportDes', 
                            'transportType',                      
                            'createDate',
                        ],
                    ]) ?>
                    <p>
                        <?= Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn
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


