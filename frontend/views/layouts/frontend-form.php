<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

$asset = AppAsset::register($this);
$baseUrl = \Yii::$app->urlManagerBackend->baseUrl;
$frontEndBaseUrl = \Yii::$app->urlManager->baseUrl;
use common\widgets\Alert;
/* @var $content string*/

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--
    Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
    Version: 3.3.0
    Author: KeenThemes
    Website: http://www.keenthemes.com/
    Contact: support@keenthemes.com
    Follow: www.twitter.com/keenthemes
    Like: www.facebook.com/keenthemes
    Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
    License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
    -->
    <!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title><?= Yii::$app->name ?> | <?= Html::encode($this->title) ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/><!-- END THEME STYLES -->
        <link rel="shortcut icon" href="<?php echo $baseUrl.'/'.UPLOAD_DIR.'/'.WWW_DIR.'/favicon.ico' ?>">
        <?php $this->head() ?>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="login">
    <?php $this->beginBody() ?>
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="menu-toggler sidebar-toggler">
    </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
    <!-- BEGIN LOGO -->
    <div class="container" style="padding-top: 30px;">
        <div class="row">
                <div class="logo text-center">
                    <img src="<?php echo($baseUrl) ?>/upload/www/logo.png" alt="logo"
                         class="logo-default" style="height: 80px;"/>
                </div>
        </div>
    </div>

    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <?= Alert::widget() ?>
    <?php echo $content; ?>
    <div class="copyright hide">
        2015 &copy; Projectemplate.
    </div>
    <!-- END LOGIN -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/respond.min.js"></script>
    <script src="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END JAVASCRIPTS -->
    <?php $this->endBody() ?>
    </body>
    <!-- END BODY -->
    </html>
<?php $this->endPage() ?>