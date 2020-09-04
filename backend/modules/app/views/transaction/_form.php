<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\AppUserTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'App User Transaction';
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
    $this->params['breadcrumbs'][] = ($model->isNewRecord) ? 'Create' : 'Update';
    $this->params['mainIcon'] = 'fa fa-list';
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
} ?>
<?php if (Yii::$app->request->isAjax) { ?>

    <?php $form = ActiveForm::begin(
        [
            'id' => 'app-user-transaction-form',
            'type' => $this->params['activeForm_type'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
            ]
        ]); ?>

    <input type="hidden" id="saveType" name="saveType">

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'external_transaction_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'user_visible')->textInput() ?>

    <?= $form->field($model, 'destination_id')->textInput() ?>

    <?= $form->field($model, 'destination_visible')->textInput() ?>

    <?= $form->field($model, 'object_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'created_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'modified_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'application_id')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>


<?php } else { ?>

    <div class="app-user-transaction-form">
        <div class="<?= $this->params['portletStyle'] ?>">
            <div class="portlet-title">
                <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                    <i class="<?php echo $this->params['mainIcon'] ?>"></i>
                    <?= 'App User Transaction' ?></span>
                    <span
                        class="caption-helper"><?= ($model->isNewRecord) ? Yii::t('common', 'title.create') : Yii::t('common', 'title.update') ?></span>
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
                    'id' => 'app-user-transaction-form',
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
                        <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'external_transaction_id')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'user_id')->textInput() ?>

                        <?= $form->field($model, 'user_visible')->widget(SwitchInput::classname(), ['containerOptions' => ['class' => '']]) ?>

                        <?= $form->field($model, 'destination_id')->textInput() ?>

                        <?= $form->field($model, 'destination_visible')->widget(SwitchInput::classname(), ['containerOptions' => ['class' => '']]) ?>

                        <?= $form->field($model, 'object_id')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'object_type')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'payment_method')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'is_active')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'created_user')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'modified_user')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'application_id')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="form-actions">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'button.create')
                            : Yii::t('common', 'button.update'), ['class' => $model->isNewRecord ? 'btn btn-success' :
                            'btn btn-primary']) ?>
                        <?php if (!$model->isNewRecord) { ?>
                            <?= Html::a(Yii::t('common', 'button.delete'), ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]); ?>
                            <?= Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                        <?php } else { ?>
                            <?= Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                        <?php } ?>                </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
<?php } ?>


