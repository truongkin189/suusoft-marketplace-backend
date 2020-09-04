<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ChangePasswordForm */
/* @var $email string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$this->title = 'Change Password';
?>
<div class="container" style="top: 5%">
    <div class="content">
        <div class="site-login">
            <div class="row">
                <div class="form-title">
                    <div class="text-center " id="title" style="font-size: 30px"><?= $this->title ?></div>
                </div>
            </div>


            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12 text-center">
                        <?php $form = ActiveForm::begin(['id' => 'change-password-form']); ?>
                        <label class="control-label visible-ie8 visible-ie9">Email</label>
                        <?= $form->field($model, 'email')->label(false)->textInput(array('placeholder' => 'Email', 'autocomplete' => 'off')); ?>

                        <label class="control-label visible-ie8 visible-ie9">Token</label>
                        <?= $form->field($model, 'token')->label(false)->textInput(array('placeholder' => 'Token', 'autocomplete' => 'off')); ?>

                        <label class="control-label visible-ie8 visible-ie9">New Password</label>
                        <?= $form->field($model, 'newPassword')->label(false)->passwordInput(array('placeholder' => 'New Password', 'autocomplete' => 'off')); ?>

                        <label class="control-label visible-ie8 visible-ie9">Repeat Password</label>
                        <?= $form->field($model, 'newPasswordRepeat')->label(false)->passwordInput(array('placeholder' => 'Repeat Password', 'autocomplete' => 'off')); ?>
                        <?= Alert::widget() ?>
                        <div class="form-group text-center">
                            <?= Html::submitButton('Change password', ['class' => 'btn btn-primary uppercase', 'name' => 'change-password-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
</div>
