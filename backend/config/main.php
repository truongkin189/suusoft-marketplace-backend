<?php
use kartik\datecontrol\Module;


$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$urlManager = require(__DIR__ . '/urlManager.php');

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\Api',
        ],
        'ecommerce' => [
            'class' => 'backend\modules\ecommerce\Ecommerce',
            'defaultRoute' => 'product',
        ],
        'app' => [
            'class' => 'backend\modules\app\App',
        ],
        'transport' => [
            'class' => 'backend\modules\transport\Transport',
        ],
        'product' => [
            'class' => 'backend\modules\product\Product',
        ],
        'category' => [
            'class' => 'backend\modules\category\Category',
        ],
        'categorysub' => [
            'class' => 'backend\modules\categorysub\CategorySub',
        ],
        'notification' => [
            'class' => 'backend\modules\notification\Notification',
        ],
        'object' => [
            'class' => 'backend\modules\object\object',
        ],
        'coupon' => [
            'class' => 'backend\modules\coupon\Coupon',
        ],
        
        'subscribe' => [

            'class' => 'backend\modules\subscribe\Subscribe',

        ],
      
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd-MM-yyyy',
                Module::FORMAT_TIME => 'HH:mm:ss a',
                Module::FORMAT_DATETIME => 'dd-MM-yyyy HH:mm:ss a',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
            'displayTimezone' => 'Asia/Ho_Chi_Minh',

            // set your timezone for date saved to db
            //'saveTimezone' => 'UTC',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => true,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],

            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ]
                ]
            ]
            // other settings
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        //Config for layout and theme
        'view' => [
            'theme' => [
                'pathMap' => ['@backend/views' => '@backend/web/themes/metronic'],
                'baseUrl' => '@backend/web/themes/metronic',
            ],
        ],
        //Remove bootstrap css
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                //disable other asset
                //bootstrap.js
//                'yii\bootstrap\BootstrapPluginAsset' => [
//                    'js' => []
//                ],
                /*
                    //jquery.js
                    'yii\web\JqueryAsset' => [
                        'js'=>[]
                    ],
                    //
                ],
                UPDATE
                As Soju mentioned in comments, another alternative way would be disabling these files in AppAsset class, which is located in ./assets/, then remove the following lines:
                public $depends = [
                    'yii\web\YiiAsset',              #REMOVE
                    'yii\bootstrap\BootstrapAsset',  #REMOVE
                    ];
                */
            ],
        ],
        //Config I18N for label  can be moved to common/config/main.php to use for both backend and frontend
        'i18n' => [
            'translations' => [
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ]
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/frontend/web/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManager' => $urlManager,
    ],
    'params' => $params,
    'language' => 'en',
];
