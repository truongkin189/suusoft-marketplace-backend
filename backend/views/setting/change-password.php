<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
$this->params['mainIcon'] = 'glyphicon glyphicon-cog';

?>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-dark">
            <span class="caption-subject bold uppercase">
                <i class="<?php echo $this->params['mainIcon'] ?>"></i>
            Site</span>
            <span class="caption-helper">Change Password</span>
        </div>
        <div class="tools">
            <a href="#" class="collapse"></a>
            <a class="fullscreen" href="#"></a>
        </div>
        <div class="actions">

        </div>
    </div>
    <div class="portlet-body">
        <div class="portlet-body form">
            <?php
            $form = ActiveForm::begin([
                'id' => 'changePassword-form',
                'type' => $this->params['activeForm_type'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
                'options' => ['class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data',
                ],
            ]) ?>
            <div class="form-body">
                <?= $form->field($model, 'oldPass')->passwordInput() ?>
                <?= $form->field($model, 'newPass')->passwordInput() ?>
                <?= $form->field($model, 'repeatNewPass')->passwordInput() ?>
            </div>
            <div class="form-actions">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-circle']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>