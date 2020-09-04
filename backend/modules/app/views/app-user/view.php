<?php

use backend\modules\app\models\AppUser;
use kartik\widgets\StarRating;
use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\AppUser */
?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'App User';
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
    $this->params['breadcrumbs'][] = Yii::t('common', 'title.view');
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
    $this->params['mainIcon'] = 'fa fa-list';
} ?><?php if (Yii::$app->request->isAjax) { ?>
    <div class="app-user-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'qb_id',
                [
                    'attribute' => 'avatar',
                    'value' => FHtml::showImageThumbnail($model->avatar, 200, 'app-user'),
                    'format' => 'html',
                ],
                'name',
                'username',
                'email:email',
                //'password',
                ///'auth_key',
                //'password_hash',
                //'password_reset_token',
                'description',
                'content:ntext',
                [
                    'attribute' => 'gender',
                    'value' => FHtml::showLabel($model->gender, $model->gender),
                    'format' => 'html',
                ],
                'dob',
                'phone',
                'weight',
                'height',
                'address',
                'country',
                'state',
                'city',
                'balance',
                'point',
                'card_number',
                'card_cvv',
                'card_exp',
                'lat',
                'long',
                'is_online',
                'is_active',
                'type',
                'status',
                'role',
                'rate',
                'rate_count',
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
                    <?= 'App User' ?>
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
                            'qb_id',
                            [
                                'attribute' => 'avatar',
                                'value' => FHtml::showImageThumbnail($model->avatar, 300, 'app-user'),
                                'format' => 'html',
                            ],
                            'name',
                            'username',
                            'email:email',
                            //'password',
                            //'auth_key',
                            //'password_hash',
                            //'password_reset_token',
                            'description',
                            'content:ntext',
                            [
                                'attribute' => 'gender',
                                'value' => FHtml::showLabel($model->gender, $model->gender),
                                'format' => 'html',
                            ],
                            'dob',
                            'phone',
                            'weight',
                            'height',
                            'address',
                            'country',
                            'state',
                            'city',
                            'balance',
                            'point',
                            'card_number',
                            'card_cvv',
                            'card_exp',
                            'lat',
                            'long',
                            [
                                'attribute' => 'is_online',
                                'value' => FHtml::showLabel($model->is_active, AppUser::getLabel($model->is_active)),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'is_active',
                                'value' => FHtml::showLabel($model->is_active, AppUser::getLabel($model->is_active)),
                                'format' => 'html',
                            ],
                            'type',
                            'status',
                            'role',
                            [
                                'attribute' => 'rate',
                                'value' => StarRating::widget([
                                    'name' => 'rating_basic',
                                    'value' => is_numeric($model->rate)? $model->rate/2 : '',
                                    'pluginOptions' => ['displayOnly' => true, 'size' => 'xs']
                                ]),
                                'format' => 'raw',
                            ],
                            'rate_count',
                            'created_date',
                            'modified_date',
                        ],
                    ]) ?>
                    <p>
                        <?= Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn
                    btn-default']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($pro_model)) { ?>
        <div class="<?= $this->params['portletStyle'] ?>">
            <div class="portlet-title">
                <div class="caption font-dark">
                <span class="caption-subject bold uppercase">
                <i class="<?php echo $this->params['mainIcon'] ?>"></i>
                    <?= 'Pro Data' ?>
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
                            'model' => $pro_model,
                            'attributes' => [
                                'user_id',
                                [
                                    'attribute' => 'rate',
                                    'value' => StarRating::widget([
                                        'name' => 'rating_basic',
                                        'value' => is_numeric($model->rate)? $model->rate/2 : '',
                                        'pluginOptions' => ['displayOnly' => true, 'size' => 'xs']
                                    ]),
                                    'format' => 'raw',
                                ],
                                'rate_count',
                                'description',
                                'business_name',
                                'business_address',
                                'business_website',
                                'business_phone',
                                [
                                    'attribute' => 'is_active',
                                    'value' => FHtml::showLabel($model->is_active, AppUser::getLabel($model->is_active)),
                                    'format' => 'html',
                                ],
                                'created_date',
                                'modified_date'
                            ],
                        ]) ?>
                        <p>
                            <?= Html::a(Yii::t('common', 'button.cancel'), ['index'], ['class' => 'btn
                    btn-default']) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>


