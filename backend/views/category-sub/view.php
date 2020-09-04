<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\categorysub\models\CategorySub */
?>
<?php if (!Yii::$app->request->isAjax) {
$this->title = 'Category Sub';
$this->params['breadcrumbs'][] = ['label' => 'Category Sub', 'url' => 'index'];
$this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
$this->params['toolBarActions'] = array(
'linkButton'=>array(),
'button'=>array(),
'dropdown'=>array(),
);
$this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
<div class="category-sub-view">

       <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                    'id',
                'id_category',
                'name',
                'created_by',
                'created_at',
                'modified_at',
    ],
    ]) ?>
</div>
<?php } else { ?>
<div class="<?= $this->params['portletStyle'] ?>">
    <div class="portlet-title">
        <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php  echo $this->params['mainIcon'] ?>"></i>
                    <?= 'Category Sub'?>
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
                           'id_category',
                           'name',
                           'created_by',
                           'created_at',
                           'modified_at',
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
