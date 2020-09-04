<?php

use backend\modules\app\models\AppUser;
use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\transport\models\TransportDriver */
/* @var $vehicle_model backend\modules\transport\models\TransportVehicle */

?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'Transport Driver';
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
    $this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
    $this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
    <div class="transport-driver-view">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'user_id',
                'driver_experience',
                'driver_license',
                'online_started',
                'online_duration',
                'fare',
                'type',
                'is_delivery',
                'is_online',
                'is_active',
                'created_date',
                'modified_date',
            ],
        ]) ?>
    </div>
<?php } else { ?>
    <div class="<?= $this->params['portletStyle'] ?>">
        <div class="portlet-title">
            <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php echo $this->params['mainIcon'] ?>"></i>
                    <?= 'Transport Driver' ?>
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
                            [
                                'attribute' => 'user_id',
                                'value' => FHtml::showAppUser($model->user_id),
                            ],
                            'driver_experience',
                            'driver_license',
                            'online_started',
                            'online_duration',
                            'fare',
                            [
                                'attribute' => 'type',
                                'value' => FHtml::showLabel($model->type),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'is_delivery',
                                'value' => FHtml::showLabel($model->is_active, AppUser::getLabel($model->is_active)),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'is_online',
                                'value' => FHtml::showLabel($model->is_active, AppUser::getLabel($model->is_active)),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'is_active',
                                'value' => FHtml::showLabel($model->is_active, AppUser::getLabel($model->is_active)),
                                'format' => 'html',
                            ],
                            'created_date',
                            'modified_date',
                        ],
                    ]) ?>
                    <p>
                        <?php if ($model->is_active != 1) { ?>
                            <?= Html::a(Yii::t('common', 'label.active'), ['active', 'id' => $model->user_id], ['class' => 'btn
                    btn-success']) ?>
                        <?php } else { ?>
                            <?= Html::a(Yii::t('common', 'label.inactive'), ['inactive', 'id' => $model->user_id], ['class' => 'btn
                    btn-danger']) ?>
                        <?php } ?>
                        <?= Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn
                    btn-default']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($vehicle_model)) { ?>
        <div class="<?= $this->params['portletStyle'] ?>">
            <div class="portlet-title">
                <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php echo $this->params['mainIcon'] ?>"></i>
                    <?= 'Transport Vehicle' ?>
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
                            'model' => $vehicle_model,
                            'attributes' => [
                                'id',
                                'user_id',
                                [
                                    'attribute' => 'image',
                                    'value' => FHtml::showImageThumbnail($vehicle_model->image, 300, 'transport-vehicle'),
                                    'format' => 'html',
                                ],
                                'permit',
                                'insurance',
                                'yearly_km',
                                'yearly_insurance',
                                'yearly_maintenance',
                                'yearly_tax',
                                'yearly_gara',
                                'yearly_unexpected',
                                'year_intend',
                                'price_4_new_tyres',
                                'average_consumption',
                                'fuel_unit_price',
                                'fuel_type',
                                'sold_value',
                                'bought_value',
                                'plate',
                                'brand',
                                'model',
                                'color',
                                'year',
                                'status',
                                'description:ntext',
                                'created_date',
                                'modified_date',
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
    <?php } ?>
<?php } ?>
