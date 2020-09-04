<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Open+Sans);

    body{
    }
    .area{
        color:#028313;
        font-weight:500;
        text-transform:uppercase;
        animation:blur 2.1s;
        text-shadow:0px 0px 5px #6de2d2,
        0px 0px 7px #fff;
    }

    @keyframes blur{
        from{
            text-shadow:0px 0px 10px #fff,
            0px 0px 10px #fff,
            0px 0px 25px #fff,
            0px 0px 25px #fff,
            0px 0px 25px #fff,
            0px 0px 25px #fff,
            0px 0px 25px #fff,
            0px 0px 25px #fff,
            0px 0px 50px #fff,
            0px 0px 50px #fff,
            0px 0px 50px #7B96B8,
            0px 0px 150px #7B96B8,
            0px 10px 100px #7B96B8,
            0px 10px 100px #7B96B8,
            0px 10px 100px #7B96B8,
            0px 10px 100px #7B96B8,
            0px -10px 100px #7B96B8,
            0px -10px 100px #7B96B8;}
    }

</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $email string*/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$this->title = 'Confirm Registration';
?>
<div class="row">
    <div class="text-center" style="text-align: center">
        <div class="content text-center">
            <h3 class="area"><?= $message ?></h3>
        </div>
    </div>
</div>
