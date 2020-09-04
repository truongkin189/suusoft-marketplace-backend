<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\object\models\ObjectCategoryAPI;
use backend\modules\product\models\ProductDealAPI;
use common\components\FHtml;
use common\components\Response;
use backend\models\Setting;
use Yii;
use \stdClass;

class ListProductByNameAction extends BaseAction
{
    public $is_secured = true;


    public function run()
    {
        // token
        $keyword = FHtml::getRequestParam('keyword', '');
        $page = FHtml::getRequestParam('page', 1);
        $number_per_page = FHtml::getRequestParam('number_per_page', 10);
        
        if(strlen($keyword) == 0)
        {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, 'Missing param', ['code'=> 202]);
        }
        
        $total = ProductDealAPI::find()->where(['is_active' => 1])->andWhere(['>','quantity',0])->andWhere(['LIKE','name',$keyword])->count();
        
        $total_page = ceil($total / $number_per_page);
        $start_index = $page * $number_per_page - $number_per_page;

        $products = ProductDealAPI::find()
        ->where(['is_active' => 1])
        ->andWhere(['>','quantity',0])
        ->andWhere(['LIKE','name',$keyword])
        ->limit($number_per_page)
        ->offset($start_index)
        ->all();

        return Response::getOutputForAPI($products, \Globals::SUCCESS, 'OK', ['code'=> 200, 'total_page' => $total_page*1]);
    }
}