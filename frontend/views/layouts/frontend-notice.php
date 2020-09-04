<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

$asset = AppAsset::register($this);
$baseUrl = \Yii::$app->urlManagerBackend->baseUrl;
$frontEndBaseUrl = \Yii::$app->urlManager->baseUrl;
use common\widgets\Alert;

/* @var $content string */

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>marketplace | <?= Html::encode($this->title) ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
              type="text/css"/>
        <link rel="shortcut icon" href="<?php echo $baseUrl . '/' . UPLOAD_DIR . '/' . WWW_DIR . '/favicon.ico' ?>">
        <?php $this->head() ?>
    </head>
    <body class="login">
    <?php $this->beginBody() ?>
    <div class="menu-toggler sidebar-toggler">
    </div>
    <div class="container" style="padding-top: 30px;">
        <div class="row">
            <div class="logo text-center">
                <img src="<?php echo($baseUrl) ?>/upload/www/logo.png" alt="logo"
                     class="logo-default" style="height: 80px;"/>
            </div>
        </div>
    </div>
    <?= Alert::widget() ?>
    <?php echo $content; ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>