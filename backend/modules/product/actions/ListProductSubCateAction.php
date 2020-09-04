<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\product\models\ProductDealAPI;
use backend\modules\object\models\ObjectCategoryAPI;
use common\components\FHtml;
use common\components\Response;
use \stdClass;

class ListProductSubCateAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $sub_id = FHtml::getRequestParam('sub_id', '');
        $page = FHtml::getRequestParam('page', 1);
        $number_per_page = FHtml::getRequestParam('number_per_page', \Globals::DEFAULT_ITEMS_PER_PAGE);

        if (strlen($sub_id) == 0) {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $recordPerPage = $number_per_page;

        $total = ProductDealAPI::find()
        ->innerJoin('object_category', 'object_category.id = product_deal.category_id')
        ->where(['object_category.id' => $sub_id])
        ->andWhere(['product_deal.is_active' => '1'])
        ->count();

        $total_page = ceil($total / $recordPerPage);
        $start_index = $page * $recordPerPage - $recordPerPage;

        // $deals = ProductDealAPI::find()->where($condition)
        // ->limit($recordPerPage)->offset($start_index)->orderBy($order)->all();

        $products = ProductDealAPI::find()
        ->innerJoin('object_category', 'object_category.id = product_deal.category_id')
        ->where(['object_category.id' => $sub_id])
        ->andWhere(['product_deal.is_active' => '1'])
        ->limit($recordPerPage)
        ->offset($start_index)
        ->all();
        
        // foreach($products as $product)
        // {
            
        // }

        return Response::getOutputForAPI($products, \Globals::SUCCESS, 'OK', ['code'=> 200], $total_page*1);

    }
}