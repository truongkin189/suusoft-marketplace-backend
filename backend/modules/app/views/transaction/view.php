<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\AppUserTransaction */
?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'App User Transaction';
    $this->params['breadcrumbs'][] = ['label' => 'App User Transactions', 'url' => 'index'];
    $this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
    $this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
    <div class="app-user-transaction-view">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'transaction_id',
                'external_transaction_id',
                [
                    'attribute' => 'user_id',
                    'value' => FHtml::showAppUser($model->user_id),
                ],
                'user_visible',
                [
                    'attribute' => 'destination_id',
                    'value' => FHtml::showAppUser($model->destination_id),
                ],
                'destination_visible',
                'object_id',
                [
                    'attribute' => 'object_type',
                    'value' => FHtml::showLabel($model->object_type, $model->object_type),
                    'format' => 'html',
                ],
                'amount',
                'currency',
                'payment_method',
                'note',
                'time',
                'action',
                'type',
                'is_active',
                'created_date',
                'created_user',
                'modified_date',
                'modified_user',
                'application_id',
            ],
        ]) ?>
    </div>
<?php } else { ?>
    <div class="<?= $this->params['portletStyle'] ?>">
        <div class="portlet-title">
            <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php echo $this->params['mainIcon'] ?>"></i>
                    <?= 'App User Transaction' ?>
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
                            'transaction_id',
                            'external_transaction_id',
                            'user_id',
                            'user_visible',
                            'destination_id',
                            'destination_visible',
                            'object_id',
                            [
                                'attribute' => 'object_type',
                                'value' => FHtml::showImageThumbnail($model->image, 500, 'app-user'),
                                'format' => 'html',
                            ],
                            'amount',
                            'currency',
                            'payment_method',
                            'note',
                            'time',
                            'action',
                            'type',
                            'is_active',
                            'created_date',
                            'created_user',
                            'modified_date',
                            'modified_user',
                            'application_id',
                        ],
                    ]) ?>
                    <p>
                        <?= Html::a(Yii::t('common', 'button.update'), ['update', 'id' => $model->id],
                            ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('common', 'button.delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item ?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?= Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn
                    btn-default']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
