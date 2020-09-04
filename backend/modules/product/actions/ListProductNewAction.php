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

class ListProductNewAction extends BaseAction
{
    public $is_secured = true;


    public function run()
    {
        $products = ProductDealAPI::find()->where(['is_active' => 1])->andWhere(['>','quantity',0])->orderBy('created_date DESC',new Expression('rand()'))->all();

        $results = array();

        $now = time();

        foreach($products as $product)
        {
            // var_dump(strtotime($product->created_date));
            // var_dump($now);
            // exit;
            
            $time_diff = time() - strtotime($product->created_date);
            if($time_diff/60/60/24 < 10)
            {
                array_push($results,$product);
            }

        }

        return Response::getOutputForAPI($results, \Globals::SUCCESS, 'OK', ['code'=> 200]);
    }
}