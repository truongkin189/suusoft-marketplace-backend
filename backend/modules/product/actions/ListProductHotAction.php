<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\object\models\ObjectCategoryAPI;
use backend\modules\product\models\ProductDealAPI;
use common\components\FHtml;
use common\components\Response;
use backend\models\Setting;
use Yii;

class ListProductHotAction extends BaseAction
{
    public $is_secured = true;


    public function run()
    {
        $hot_id = array();

        $categories = ObjectCategoryAPI::find()->where(['is_hot' => 1, 'is_active' => 1])->all();

        foreach($categories as $category)
        {
            array_push($hot_id, $category->id);
        }

        $products = ProductDealAPI::find()->where(['IN','category_id', $hot_id])->andWhere(['is_active' => 1])->andWhere(['>','quantity',0])->all();

        return Response::getOutputForAPI($products, \Globals::SUCCESS, 'OK', ['code'=> 200]);
    }
}