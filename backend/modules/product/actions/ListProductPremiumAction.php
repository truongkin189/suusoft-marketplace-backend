<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\object\models\ObjectCategoryAPI;
use backend\modules\product\models\ProductDealAPI;
use common\components\FHtml;
use common\components\Response;
use backend\models\Setting;
use Yii;
use yii\db\Expression;

class ListProductPremiumAction extends BaseAction
{
    public $is_secured = true;


    public function run()
    {
        $products = ProductDealAPI::find()->where(['is_active' => 1,'is_premium' => 1])->andWhere(['>','quantity',0])->orderBy('created_date DESC',new Expression('rand()'))->limit(50)->all();

        return Response::getOutputForAPI($products, \Globals::SUCCESS, 'OK', ['code'=> 200]);
    }
}