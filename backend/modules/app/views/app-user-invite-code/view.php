<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;
use backend\modules\app\models\invitecode\AppUserInviteCode;
use backend\models\Setting;

/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\invitecode\AppUserInviteCode */
?>
<?php if (!Yii::$app->request->isAjax) {
$this->title = 'App User Invite Code';
$this->params['breadcrumbs'][] = ['label' => 'App User Invite Code', 'url' => 'index'];
$this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
$this->params['toolBarActions'] = array(
'linkButton'=>array(),
'button'=>array(),
'dropdown'=>array(),
);
$this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
<div class="app-user-invite-code-view">

       <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                    'id',
                [
                    'attribute' => 'user_id',
                    'value' => FHtml::showCategory(AppUserInviteCode::getUserInvited($model->user_id)),
                    'format' => 'html',
                ],
                'invite_code',
                [
                    'attribute' => 'invite_bonus_point',
                    'value' => FHtml::showCategory(Setting::getSettingValueByKey(\Globals::INVITE_BONUS_POINT)),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'status',
                    'value' => FHtml::showLabel($model->status, AppUserInviteCode::getStatusLabel($model->status)),
                    'format' => 'html',
                ],
    ],
    ]) ?>
</div>
<?php } else { ?>
<div class="<?= $this->params['portletStyle'] ?>">
    <div class="portlet-title">
        <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php  echo $this->params['mainIcon'] ?>"></i>
                    <?= 'App User Invite Code'?>
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
                           [
                            'attribute' => 'user_id',
                            'value' => FHtml::showCategory(AppUserInviteCode::getUserInvited($model->user_id)),
                            'format' => 'html',
                            ],
                           'invite_code',
                           [
                                'attribute' => 'invite_bonus_point',
                                'value' => FHtml::showCategory(Setting::getSettingValueByKey(\Globals::INVITE_BONUS_POINT)),
                                'format' => 'html',
                            ],
                           [
                            'attribute' => 'status',
                            'value' => FHtml::showLabel($model->status, AppUserInviteCode::getStatusLabel($model->status)),
                            'format' => 'html',
                            ],
                        //   'created_at',
                           
                        //    'status',
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
