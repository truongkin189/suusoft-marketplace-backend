<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\ProductDeal */
/* @var $form yii\widgets\ActiveForm */
?>

<?php if (!Yii::$app->request->isAjax) {
$this->title = 'Product Deal';
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
            'id' => 'product-deal-form',
            'type' => $this->params['activeForm_type'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
            ]
        ]); ?>

<input type="hidden" id="saveType" name="saveType">

    <?= $form->field($model, 'seller_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attachment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'sale_price')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'discount_rate')->textInput() ?>

    <?= $form->field($model, 'discount_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_expired')->textInput() ?>

    <?= $form->field($model, 'is_online')->textInput() ?>

    <?= $form->field($model, 'online_started')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'online_duration')->textInput() ?>

    <?= $form->field($model, 'is_premium')->textInput() ?>

    <?= $form->field($model, 'is_renew')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'view_count')->textInput() ?>

    <?= $form->field($model, 'like_count')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'rate_count')->textInput() ?>

    <?= $form->field($model, 'reservation_count')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'created_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'modified_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'application_id')->textInput(['maxlength' => true]) ?>

   <?php ActiveForm::end(); ?>


<?php } else { ?>

<div class="product-deal-form">
    <div class="<?= $this->params['portletStyle'] ?>">
        <div class="portlet-title">
            <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                    <i class="<?php  echo $this->params['mainIcon'] ?>"></i>
                    <?= 'Product Deal'?></span>
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
            'id' => 'product-deal-form',
            'type' => $this->params['activeForm_type'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data'
                            ]
            ]);
             ?>


            <div class="form">
                <div class="form-body">
                    <?php
                        $deal_image = $model->images;
                    ?>
                    
                           <?= $form->field($model, 'seller_id')->textInput() ?>

       <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'image_file')->widget(FileInput::classname(),
                                    ['options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'],
                                        'pluginOptions' => [
                                            'previewFileType' => 'image',
                                            'showRemove' => false,
                                            'showUpload' => false
                                        ]
                                    ]);?>

                                <?= $form->field($model, 'attachment_file')->widget(FileInput::classname(),
                                    ['options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'],
                                        'pluginOptions' => [
                                            'previewFileType' => 'image',
                                            'showRemove' => false,
                                            'showUpload' => false
                                        ]
                                    ]);?>
                                    
        
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

       <?= $form->field($model, 'price')->textInput() ?>

       <?= $form->field($model, 'sale_price')->textInput() ?>

       <?= $form->field($model, 'discount')->textInput() ?>

       <?= $form->field($model, 'discount_rate')->textInput() ?>

       <?= $form->field($model, 'discount_type')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'discount_expired')->widget(\kartik\widgets\DateTimePicker::classname(), [
                            'options' => ['placeholder' => 'Select time ...'],
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]) ?>

       <?= $form->field($model, 'is_online')->widget(SwitchInput::classname(), ['containerOptions' => ['class' => '']]) ?>

       <?= $form->field($model, 'online_started')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'online_duration')->textInput() ?>

       <?= $form->field($model, 'is_premium')->widget(SwitchInput::classname(), ['containerOptions' => ['class' => '']]) ?>

       <?= $form->field($model, 'is_renew')->widget(SwitchInput::classname(), ['containerOptions' => ['class' => '']]) ?>

       <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'is_active')->widget(SwitchInput::classname(), ['containerOptions' => ['class' => '']]) ?>

       <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'view_count')->textInput() ?>

       <?= $form->field($model, 'like_count')->textInput() ?>

       <?= $form->field($model, 'rate')->textInput() ?>

       <?= $form->field($model, 'rate_count')->textInput() ?>

       <?= $form->field($model, 'reservation_count')->textInput() ?>

       <?= $form->field($model, 'created_user')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'modified_user')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'application_id')->textInput(['maxlength' => true]) ?>

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


