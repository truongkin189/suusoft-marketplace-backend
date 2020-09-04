<?php
namespace backend\controllers;
use backend\modules\app\App;
use common\components\FHtml;
use kartik\form\ActiveForm;
use Yii;
use yii\web\Controller;


class BackendController extends Controller
{
    public $mainMenu = array();
    public $uploadFolder;

    public function init()
    {
        parent::init();
        $this->view->params['toolBarActions'] = FHtml::config('toolBarActions', array());
        $this->view->params['uploadFolder'] = $this->uploadFolder;
        $isAjax = FHtml::config('isAjax', false);
        $this->view->params['isAjax'] = $isAjax;
        $this->view->params['displayType'] = $isAjax ? "modal-remote" : "";

        $isMD = FHtml::config('isMD', true); //material design

        if ($isMD == false) {
            $this->view->params['cssComponents'] = "components-rounded";
            $this->view->params['cssPlugins'] = "plugins";
            $this->view->params['page-md'] = "";
        } else {
            $this->view->params['cssComponents'] = "components-md";
            $this->view->params['cssPlugins'] = "plugins-md";
            $this->view->params['page-md'] = "page-md";
        }
        $this->view->params['portletStyle'] = FHtml::config('portletStyle', \Globals::WIDGET_TYPE_BOX);


        $color = (FHtml::config('portletStyle', \Globals::WIDGET_TYPE_BOX) == \Globals::WIDGET_TYPE_BOX) ? FHtml::config('mainColor', \Globals::WIDGET_COLOR_DEFAULT) : '';

        $this->view->params['portletStyle'] = 'portlet'.' '.\Globals::WIDGET_TYPE_LIGHT. ' ' .$color;
        $this->view->params['mainIcon'] = FHtml::config('mainIcon', '');
        $this->view->params['mainColor'] = FHtml::config('mainColor', \Globals::WIDGET_COLOR_DEFAULT);
        $this->view->params['displayPortlet'] = FHtml::config('displayPortlet', true);
        $this->view->params['activeForm_type'] = FHtml::config('activeForm_type', ActiveForm::TYPE_HORIZONTAL);
        $this->view->params['displayPageContentHeader'] = FHtml::config('displayPageContentHeader', true);

    }

    public function beforeAction($action){
        $this->uploadFolder = Yii::getAlias('@'.UPLOAD_DIR);
        $this->createMenu();
        return parent::beforeAction($action);
    }


    public function createMenu(){
        $controller=$this->getUniqueId();
        $action = $this->action->id;

        $menu = array(
            array(
                'active' => $controller == 'site' && ( $action == 'index' || $action == 'error'),
                'name' => Yii::t('common', 'menu.home'),
                'icon' => 'glyphicon glyphicon-home',
                'url' => Yii::$app->urlManager->createUrl(['/site/index']),
            ),
//            array(
//                'active' => $controller == 'category',
//                'name' => Yii::t('common', 'menu.category'),
//                'icon' => 'fa fa-list',
//                'url' => Yii::$app->urlManager->createUrl(['/category/index']),
//            ),
//            array(
//                'active' => $controller == 'setting',
//                'name' => 'Settings',
//                'icon' => 'glyphicon glyphicon-cog',
//                'children' => array(
//                    array(
//                        'label' => 'General Settings',
//                        'url' => Yii::$app->urlManager->createUrl(['/setting/index']),
//                        'active' => $controller == 'settings' AND $action == 'index',
//                        'icon' => 'glyphicon glyphicon-cog',
//                    ),
//                    array(
//                        'label' => 'Change Password',
//                        'url' => Yii::$app->urlManager->createUrl(['/setting/change-password']),
//                        'active' => $controller == 'settings' AND $action == 'change-password',
//                        'icon' => 'fa fa-user'
//                    )
//                ),
//            )
        );

        $menu = array_merge($menu, App::createModuleMenu());
        $menu[] = array(
            'name' => Yii::t('common', 'menu.about'),
            'url' => Yii::$app->urlManager->createUrl(['/site/about']),
            'active' => $controller == 'site' AND $action == 'about',
            'icon' => 'fa fa-info-circle'
        );
        $menu[] = array(
            'name' => Yii::t('common', 'menu.setting'),
            'url' => Yii::$app->urlManager->createUrl(['/setting/index']),
            'active' => $controller == 'setting',
            'icon' => 'glyphicon glyphicon-cog'
        );

        $this->mainMenu = $menu;
        $this->view->params['mainMenu'] = $this->mainMenu;
    }
}

