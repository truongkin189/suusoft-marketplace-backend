<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use common\components\FHtml;

$this->title = 'Settings';
$this->params['breadcrumbs'][] = 'Settings';
$this->params['mainIcon'] = 'glyphicon glyphicon-cog';

/* @var $model \backend\models\SettingForm */
?>

<?php /*
<div class="settings-form">
    <div class="portlet box <?php echo $this->params['mainColor'] ?>">
        <div class="portlet-title">
            <div class="caption">
                <i class="<?php echo $this->params['mainIcon'] ?>"></i>Settings
            </div>
            <div class="tools">
                <a class="btn-icon-only fullscreen" href="#">
                </a>
                <a href="" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <?php
            $form = ActiveForm::begin([
                'id' => 'settings-form',
                'type' => $this->params['activeForm_type'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
                'options' => ['class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data',
                ],
            ]) ?>
            <div class="form-body">
                <?= $form->field($model, 'api_key') ?>
                <?= $form->field($model, 'pem')->fileInput()->hint('Old pem: '.$model->pem) ?>
            </div>
            <div class="form-actions">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
*/
?>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-dark">
            <span class="caption-subject bold uppercase">
                <i class="<?php echo $this->params['mainIcon'] ?>"></i>
            Settings</span>
            <span class="caption-helper">customization</span>
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
                'id' => 'settings-form',
                'type' => $this->params['activeForm_type'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
                'options' => ['class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data',
                ],
            ]) ?>

            <div class="form-body">
                <?= $form->field($model, 'admin_email') ?>
                <!--<?= $form->field($model, 'api_key') ?>-->
                <?= $form->field($model, 'key_push') ?>
                <?= $form->field($model, 'pem')->fileInput()->hint('Old pem: ' . $model->pem) ?>
                
                <!-- added 2:28 16/8/19-->
                <?= $form->field($model, 'invite_bonus_point') ?>
                <?= $form->field($model, 'searching_product_distance') ?>
                <!--end-->
                
                <!--added 4:23 21/8/19-->
                <?= $form->field($model, 'commission_rate') ?>
                <!--end-->
               
                
                <!--<?= $form->field($model, 'exchange_rate') ?>-->
                <!--<?= $form->field($model, 'deal_online_rate') ?>-->
                <!--<?= $form->field($model, 'premium_deal_online_rate') ?>-->
             
                <?= $form->field($model, 'exchange_fee') ?>
                <?= $form->field($model, 'redeem_fee') ?>
                <?= $form->field($model, 'transfer_fee') ?>
                
                <?= $form->field($model, 'banner_file_1')->widget(FileInput::classname(),
                                    ['options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'],
                                        'pluginOptions' => [
                                            'previewFileType' => 'image',
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'initialCaption'=> isset($model->image_banner_1) ? $model->image_banner_1 : '',
                                            'initialPreview'=> isset($model->image_banner_1) ? FHtml::showImageThumbnail($model->image_banner_1, false, 'banner') : '',
                                            'mainClass' => 'input-group-xs'
                                        ]
                                    ]);?>

                <?= $form->field($model, 'banner_file_2')->widget(FileInput::classname(),
                                    ['options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'],
                                        'pluginOptions' => [
                                            'previewFileType' => 'image',
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'initialCaption'=> isset($model->image_banner_2) ? $model->image_banner_2 : '',
                                            'initialPreview'=> isset($model->image_banner_2) ? FHtml::showImageThumbnail($model->image_banner_2, false, 'banner') : '',
                                        ]
                                    ]);?>

                <?= $form->field($model, 'banner_file_3')->widget(FileInput::classname(),
                                    ['options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'],
                                        'pluginOptions' => [
                                            'previewFileType' => 'image',
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'initialCaption'=> isset($model->image_banner_3) ? $model->image_banner_3 : '',
                                            'initialPreview'=> isset($model->image_banner_3) ? FHtml::showImageThumbnail($model->image_banner_3, false, 'banner') : '',
                                        ]
                                    ]);?>   

                <?= $form->field($model, 'banner_file_4')->widget(FileInput::classname(),
                                    ['options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'],
                                        'pluginOptions' => [
                                            'previewFileType' => 'image',
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'initialCaption'=> isset($model->image_banner_4) ? $model->image_banner_4 : '',
                                            'initialPreview'=> isset($model->image_banner_4) ? FHtml::showImageThumbnail($model->image_banner_4, false, 'banner') : '',
                                        ]
                                    ]);?>      
                
                <?php
                $kcfOptions = array_merge(\iutbay\yii2kcfinder\KCFinder::$kcfDefaultOptions, [
                    'uploadURL' => Yii::getAlias('@web') . '/upload/editor',
                    'access' => [
                        'files' => [
                            'upload' => true,
                            'delete' => false,
                            'copy' => false,
                            'move' => false,
                            'rename' => false,
                        ],
                        'dirs' => [
                            'create' => true,
                            'delete' => false,
                            'rename' => false,
                        ],
                    ],
                ]);
                Yii::$app->session->set('KCFINDER', $kcfOptions);
                ?>

                <?= $form->field($model, 'page_faq')->widget(\common\components\CoconutEditor::className(), [
                    'options' => [
                        'rows' => 10,
                        //'disabled' => false
                    ],
                    'preset' => 'full',
                ]) ?>
                <?= $form->field($model, 'page_about')->widget(\common\components\CoconutEditor::className(), [
                    'options' => [
                        'rows' => 10,
                        //'disabled' => false
                    ],
                    'preset' => 'full',
                ]) ?>
                <?= $form->field($model, 'page_help')->widget(\common\components\CoconutEditor::className(), [
                    'options' => [
                        'rows' => 10,
                        //'disabled' => false
                    ],
                    'preset' => 'full',
                ]) ?>
                <?= $form->field($model, 'page_term')->widget(\common\components\CoconutEditor::className(), [
                    'options' => [
                        'rows' => 10,
                        //'disabled' => false
                    ],
                    'preset' => 'full',
                ]) ?>
            </div>
            <div class="form-actions">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-circle']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>