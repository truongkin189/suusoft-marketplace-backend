<?php

use backend\modules\app\models\AppUserTransactionRequest;
use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;
use backend\modules\app\models\AppUser;

/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\AppUserTransactionRequest */
?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'App User Transaction Request';
    $this->params['breadcrumbs'][] = ['label' => 'App User Transaction Requests', 'url' => 'index'];
    $this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
    $this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
    <div class="app-user-transaction-request-view">
        <?php 
            $app_user = AppUser::findOne(['id' => $model->user_id]);
        ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'value' => $app_user->balance,
                    'label' => 'Balance'
                ],
                [
                    'attribute' => 'user_id',
                    'value' => FHtml::showAppUser($model->user_id),
                ],
//                [
//                    'attribute' => 'destination_id',
//                    'value' => FHtml::showAppUser($model->destination_id),
//                ],
                'amount',
                [
                    'attribute' => 'type',
                    'value' => AppUserTransactionRequest::getLabel($model->type),
                    'format' => 'html'
                ],
                'note:ntext',
                [
                    // 'attribute' => 'type',
                    'value' => FHtml::showLabel($model->status, AppUserTransactionRequest::getLabel($model->status)),
                    'format' => 'html',
                    'label' => 'Status'
                ],
                'time',
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
                    <?= 'App User Transaction Request' ?>
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
                            'user_id',
                            'destination_id',
                            'amount',
                            [
                                'attribute' => 'type',
                                'value' => AppUserTransactionRequest::getLabel($model->type),
                                'format' => 'html'
                            ],
                            'note:ntext',
                            [
                                'attribute' => 'type',
                                'value' => AppUserTransactionRequest::getLabel($model->status),
                                'format' => 'html'
                            ],
                            'time',
                            'created_date',
                            'modified_date',
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
