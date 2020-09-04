<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;
use backend\modules\product\models\ProductDealImage;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\ProductDeal */
?>
<?php if (!Yii::$app->request->isAjax) {
$this->title = 'Product Deal';
$this->params['breadcrumbs'][] = ['label' => 'Product Deal', 'url' => 'index'];
$this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
$this->params['toolBarActions'] = array(
'linkButton'=>array(),
'button'=>array(),
'dropdown'=>array(),
);
$this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
<div class="product-deal-view">

<?php 

        $photo = ProductDealImage::find()
            ->where(['product_deal_id' => $model->id])
            ->all();

    ?>
       <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                    'id',
                'seller_id',
                'category_id',
                    [
                        'attribute' => 'image',
                        'value' =>  (isset($photo[0])) ? FHtml::showImageThumbnail($photo[0]->image, 300, 'product-deal') : 'No Image',
                        'format' => 'html',
                        'label' => 'Image 1'
                    ],
                    [
                            'attribute' => 'image',
                            'value' =>  (isset($photo[1])) ? FHtml::showImageThumbnail($photo[1]->image, 300, 'product-deal') : 'No Image',
                            'format' => 'html',
                            'label' => 'Image 2'
                    ],
                    [
                        'attribute' => 'image',
                        'value' => (isset($photo[2])) ? FHtml::showImageThumbnail($photo[2]->image, 300, 'product-deal') : 'No Image',
                        'format' => 'html',
                        'label' => 'Image 3'
                    ],
                    [
                        'attribute' => 'image',
                        'value' => (isset($photo[3])) ? FHtml::showImageThumbnail($photo[3]->image, 300, 'product-deal') : 'No Image',
                        'format' => 'html',
                        'label' => 'Image 4'
                    ],
                'attachment',
                'name',
                'description',
                // 'content:ntext',
                // 'product_id',
                'price',
                'sale_price',
                'discount',
                // 'discount_rate',
                'discount_type',
                // 'discount_expired',
                // 'is_online',
                // 'online_started',
                // 'online_duration',
                // 'is_premium',
                // 'is_renew',
                // 'status',
                'is_active',
                // 'lat',
                // 'long',
                // 'country',
                // 'state',
                // 'city',
                // 'address',
                'view_count',
                'like_count',
                // 'rate',
                // 'rate_count',
                // 'reservation_count',
                'created_date',
                'created_user',
                'modified_date',
                'modified_user',
                // 'application_id',
    ],
    ]) ?>
</div>
<?php } else { ?>
<div class="<?= $this->params['portletStyle'] ?>">
    <div class="portlet-title">
        <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php  echo $this->params['mainIcon'] ?>"></i>
                    <?= 'Product Deal'?>
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
                           'seller_id',
                           'category_id',
                           [
                           'attribute' => 'image',
                           'value' => FHtml::showImageThumbnail($model->image, 300, 'product-deal'),
                           'format' => 'html',
                           ],
                           'attachment',
                           'name',
                           'description',
                           'content:ntext',
                           'product_id',
                           'price',
                           'sale_price',
                           'discount',
                           'discount_rate',
                           'discount_type',
                           'discount_expired',
                           'is_online',
                           'online_started',
                           'online_duration',
                           'is_premium',
                           'is_renew',
                           'status',
                           'is_active',
                           'lat',
                           'long',
                           'country',
                           'state',
                           'city',
                           'address',
                           'view_count',
                           'like_count',
                           'rate',
                           'rate_count',
                           'reservation_count',
                           'created_date',
                           'created_user',
                           'modified_date',
                           'modified_user',
                           'application_id',
                ],
                ]) ?>
                <p>
                    <?=  Html::a( Yii::t('common', 'button.update'), ['update', 'id' => $model->id],
                    ['class' => 'btn btn-primary']) ?>
                    <?=  Html::a( Yii::t('common', 'button.delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                    'confirm' => 'Are you sure you want to delete this item ?',
                    'method' => 'post',
                    ],
                    ]) ?>
                    <?=  Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn
                    btn-default']) ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php } ?>
