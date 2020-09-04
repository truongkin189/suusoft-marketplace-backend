<?php

namespace backend\modules\app;
use common\components\FHtml;
use Yii;

/**
 * app module definition class
 */
class App extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\app\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }

    public static function createModuleMenu(){
        $controller=FHtml::currentController();
        $action = FHtml::currentAction();
        $module = FHtml::currentModule();

        return
            array(
                // array(
                //     'active' => ($module == 'app' && $controller == 'app-user') || $module == 'transport',
                //     'name' => Yii::t('common', 'menu.user'),
                //     'icon' => 'glyphicon glyphicon-user',
                //     'children' => array(
                //         array(
                //             'label' => Yii::t('common', 'menu.user'),
                //             'url' => Yii::$app->urlManager->createUrl(['app/app-user/index']),
                //             'active' => $controller == 'app-user',
                //             'icon' => '',
                //         ),
                //         array(
                //             'label' => Yii::t('common', 'menu.driver'),
                //             'url' => Yii::$app->urlManager->createUrl(['transport/driver/index']),
                //             'active' => $controller == 'driver',
                //             'icon' => '',
                //         )
                //     ),
                // ),
                array(
                    'active' => $module == 'app' && ($controller == 'category'),
                    'name' => Yii::t('common', 'Category'),
                    'icon' => 'glyphicon glyphicon-duplicate',
                    'children' => array(
                        array(
                            'label' => Yii::t('common', 'Category'),
                            'url' => Yii::$app->urlManager->createUrl(['object/object-category/index']),
                            'active' => $controller == 'category',
                            'icon' => '',
                        ),
                        array(
                            'label' => Yii::t('common', 'Sub Category'),
                            'url' => Yii::$app->urlManager->createUrl(['object/object-category/sub']),
                            'active' => $controller == 'category',
                            'icon' => '',
                        )
                    ),
                ),
                
                array(
                    'active' => $module == 'product' && ($controller == 'product-deal'),
                    'name' => Yii::t('common', 'Product'),
                    'icon' => 'glyphicon glyphicon-duplicate',
                    'children' => array(
                        array(
                            'label' => Yii::t('common', 'Index'),
                            'url' => Yii::$app->urlManager->createUrl(['product/product-deal/index']),
                            'active' => $controller == 'category',
                            'icon' => '',
                        ),
                        array(
                            'label' => Yii::t('common', 'Inactive'),
                            'url' => Yii::$app->urlManager->createUrl(['product/product-deal/inactive']),
                            'active' => $controller == 'category',
                            'icon' => '',
                        )
                    ),
                ),
                
                // array(
                //     'active' => $module == 'app' && ($controller == 'goods'),
                //     'name' => Yii::t('common', 'Goods'),
                //     'icon' => 'glyphicon glyphicon-tags',
                //     'children' => array(
                //         array(
                //             'label' => Yii::t('common', 'Goods'),
                //             'url' => Yii::$app->urlManager->createUrl(['goods/goods/index']),
                //             'active' => $controller == 'goods',
                //             'icon' => '',
                //         ),
                //     ),
                // ),

                array(
                    'active' => $module == 'app' && 
                            ($controller == 'transaction' || $controller == 'request' 
                            || $controller == 'app-user-refund-request' || $controller == 'app-user-report-request'),
                    'name' => Yii::t('common', 'Transactions'),
                    'icon' => 'fa fa-money',
                    'children' => array(
                        array(
                            'label' => Yii::t('common', 'Transactions'),
                            'url' => Yii::$app->urlManager->createUrl(['app/transaction/index']),
                            'active' => $controller == 'transaction',
                            'icon' => '',
                        ),
                        array(
                            'label' => Yii::t('common', 'Request Withdrawal'),
                            'url' => Yii::$app->urlManager->createUrl(['app/request/index']),
                            'active' => $controller == 'request',
                            'icon' => '',
                        ),
                        array(
                            'label' => Yii::t('common', 'Refund Request'),
                            'url' => Yii::$app->urlManager->createUrl(['app/app-user-refund-request/index']),
                            'active' => $controller == 'app-user-refund-request',
                            'icon' => '',
                        ),
                        array(
                            'label' => Yii::t('common', 'Report Request'),
                            'url' => Yii::$app->urlManager->createUrl(['app/app-user-report-request/index']),
                            'active' => $controller == 'app-user-report-request',
                            'icon' => '',
                        ),
                    ),
                ),

                array(
                    'active' => $module == 'product' && ($controller == 'order'),
                    'name' => Yii::t('common', 'Order'),
                    'icon' => 'glyphicon glyphicon-list-alt',
                    'children' => array(
                        array(
                            'label' => 'All',
                            'url' => Yii::$app->urlManager->createUrl(['product/order/index']),
                            'active' => $action == 'index',
                            'icon' => '',
                            ),
                         array(
                            'label' => 'Processing',
                            'url' => Yii::$app->urlManager->createUrl(['product/order/waiting']),
                            'active' => $action == 'waiting',
                            'icon' => '',
                            ),

                          array(
                            'label' => 'Paid',
                            'url' => Yii::$app->urlManager->createUrl(['product/order/paid']),
                            'active' => $action == 'paid',
                            'icon' => '',
                            ),


                          array(
                            'label' => 'Completed',
                            'url' => Yii::$app->urlManager->createUrl(['product/order/completed']),
                            'active' => $action == 'completed',
                            'icon' => '',
                            ),

                           array(
                            'label' => 'Rejected',
                            'url' => Yii::$app->urlManager->createUrl(['product/order/rejected']),
                            'active' => $action == 'rejected',
                            'icon' => '',
                            ),
                    ),
                ),
                
                array(
                    'active' => $module == 'app-user' && ($controller == 'app-user'),
                    'name' => Yii::t('common', 'User'),
                    'icon' => 'glyphicon glyphicon-user',
                    'children' => array(
                        array(
                            'label' => Yii::t('common', 'User'),
                            'url' => Yii::$app->urlManager->createUrl(['app/app-user/user']),
                            'active' => $action == 'user',
                            'icon' => '',
                        ),
                        array(
                            'label' => Yii::t('common', 'Seller'),
                            'url' => Yii::$app->urlManager->createUrl(['app/app-user/seller']),
                            'active' => $action == 'seller',
                            'icon' => '',
                        ),
                        array(
                            'label' => Yii::t('common', 'Buyer'),
                            'url' => Yii::$app->urlManager->createUrl(['app/app-user/buyer']),
                            'active' => $action == 'buyer',
                            'icon' => '',
                        )
                    ),
                ),


                array(
                    'active' => $module == 'notification' && 
                    ($controller == 'notification'),
                    'name' => Yii::t('common', 'Push Notification'),
                    'icon' => 'glyphicon glyphicon-bell',
                    'children' => array(
                        // array(
                        //     'label' => Yii::t('common', 'Index'),
                        //     'url' => Yii::$app->urlManager
                        //         ->createUrl(['notification/notification/index']),
                        //     // 'active' => $controller == 'notification',
                        //     'active' => $action == 'all-seller',
                        //     'icon' => '',
                        // ),
                        array(
                            'label' => Yii::t('common', 'All Seller'),
                            'url' => Yii::$app->urlManager
                                ->createUrl(['notification/notification/create-all-seller']),
                            // 'active' => $controller == 'notification',
                            'active' => $action == 'all-seller',
                            'icon' => '',
                        ),
                        array(
                            'label' => Yii::t('common', 'All Buyer'),
                            'url' => Yii::$app->urlManager
                            ->createUrl(['notification/notification/create-all-buyer']),
                            // 'active' => $controller == 'notification',
                            'active' => $action == 'all-buyer',
                            'icon' => '',
                        ),
                        // array(
                        //     'label' => Yii::t('common', 'Each Seller'),
                        //     'url' => Yii::$app->urlManager
                        //     ->createUrl(['notification/notification/create-each-seller']),
                        //     // 'active' => $controller == 'notification',
                        //     'active' => $action == 'each-seller',
                        //     'icon' => '',
                        // ),
                        // array(
                        //     'label' => Yii::t('common', 'Each Buyer'),
                        //     'url' => Yii::$app->urlManager
                        //     ->createUrl(['notification/notification/create-each-buyer']),
                        //     // 'active' => $controller == 'notification',
                        //     // 'active' => $action == 'each-buyer',
                        //     'icon' => '',
                        // )
                    ),
                ),
                
                array(
                    'active' => $module == 'app' && ($controller == 'app-user-invite-code'),
                    'name' => Yii::t('common', 'Invite Code'),
                    'icon' => 'glyphicon glyphicon-user',
                    'children' => array(
                        array(
                            'label' => Yii::t('common', 'Index'),
                            'url' => Yii::$app->urlManager->createUrl(['app/app-user-invite-code/index']),
                            'active' => $controller == 'category',
                            'icon' => '',
                        )
                    ),
                ),
                
                array(
                    'active' => $module == 'app' && ($controller == 'app-user-help-request'),
                    'name' => Yii::t('common', 'Help'),
                    'icon' => 'glyphicon glyphicon-question-sign',
                    'children' => array(
                        array(
                            'label' => Yii::t('common', 'Help'),
                            'url' => Yii::$app->urlManager->createUrl(['app/app-user-help-request/index']),
                            'active' => $controller == 'app-user-help-request',
                            'icon' => '',
                        )
                    ),
                ),
                
                array(
                    'active' => $module == 'coupon' && ($controller == 'coupon'),
                    'name' => Yii::t('common', 'Coupon'),
                    'icon' => 'glyphicon glyphicon-scissors',
                    'children' => array(
                        array(
                            'label' => Yii::t('common', 'Coupon'),
                            'url' => Yii::$app->urlManager->createUrl(['coupon/coupon/index']),
                            'active' => $controller == 'coupon',
                            'icon' => '',
                        )
                    ),
                ),
            );

    }

}
