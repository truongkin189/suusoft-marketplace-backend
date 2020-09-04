<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\OrderDetail */

?>
<div class="order-detail-create">
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>
</div>
