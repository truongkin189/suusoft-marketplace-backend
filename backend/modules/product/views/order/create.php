<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Order */

?>
<div class="order-create">
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>
</div>
