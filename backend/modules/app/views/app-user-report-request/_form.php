<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\appuserreport\AppUserReportRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<?php if (!Yii::$app->request->isAjax) {
$this->title = 'App User Report Request';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
$this->params['breadcrumbs'][] = ($model->isNewRecord)?'Create' : 'Update';
$this->params['mainIcon'] = 'fa fa-list';
$this->params['toolBarActions'] = array(
'linkButton'=>array(),
'button'=>array(),
'dropdown'=>array(),
);
} ?>
<?php if (Yii::$app->request->isAjax) { ?>

<?php $form = ActiveForm::begin(
        [
            'id' => 'app-user-report-request-form',
            'type' => $this->params['activeForm_type'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
            ]
        ]); ?>

<input type="hidden" id="saveType" name="saveType">

    <?= $form->field($model, 'buyer_id')->textInput() ?>

    <?= $form->field($model, 'seller_id')->textInput() ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'modified_at')->textInput() ?>

   <?php ActiveForm::end(); ?>


<?php } else { ?>

<div class="app-user-report-request-form">
    <div class="<?= $this->params['portletStyle'] ?>">
        <div class="portlet-title">
            <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                    <i class="<?php  echo $this->params['mainIcon'] ?>"></i>
                    <?= 'App User Report Request'?></span>
                <span class="caption-helper"><?=($model->isNewRecord) ? Yii::t('common', 'title.create') : Yii::t('common', 'title.update')?></span>
            </div>
            <div class="tools">
                <a href="#" class="collapse"></a>
                <a href="#" class="fullscreen"></a>
            </div>
            <div class="actions">
            </div>
        </div>
        <div class="portlet-body form">
            <?php $form = ActiveForm::begin([
            'id' => 'app-user-report-request-form',
            'type' => $this->params['activeForm_type'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
                            ]
            ]);
             ?>


            <div class="form">
                <div class="form-body">
                           <?= $form->field($model, 'buyer_id')->textInput() ?>

       <?= $form->field($model, 'seller_id')->textInput() ?>

       <?= $form->field($model, 'order_id')->textInput() ?>

       <?= $form->field($model, 'product_id')->textInput() ?>

       <?= $form->field($model, 'status')->hiddenInput(['value' => 0])->label(false) ?>

       <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

       <!-- <?= $form->field($model, 'created_at')->widget(\kartik\widgets\DateTimePicker::classname(), [
                            'options' => ['placeholder' => 'Select time ...'],
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]) ?>

       <?= $form->field($model, 'modified_at')->widget(\kartik\widgets\DateTimePicker::classname(), [
                            'options' => ['placeholder' => 'Select time ...'],
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]) ?> -->

                </div>
                <div class="form-actions">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'button.create')
                    : Yii::t('common', 'button.update'), ['class' => $model->isNewRecord ? 'btn btn-success' :
                    'btn btn-primary']) ?>
                    <?php  if (!$model->isNewRecord) {?>
                    <?=  Html::a(Yii::t('common', 'button.delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                    ],
                    ]); ?>
                    <?=  Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                    <?php } else { ?>
                    <?=  Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                    <?php } ?>                </div>
            </div>
               <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
<?php } ?>


