<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\object\models\ObjectCategoryAPI;
use backend\modules\product\models\OrderAPI;
use backend\modules\product\models\OrderDetailAPI;
use backend\modules\product\models\ProductDeal;
use common\components\FHtml;
use common\components\Response;
use \stdClass;

class ListOrderSellerAction extends BaseAction
{
    public function run()
    {
        // lay order co status la delivered
        $seller_id = FHtml::getRequestParam('seller_id', '');
        $page = FHtml::getRequestParam('page', 1);
        $number_per_page = FHtml::getRequestParam('number_per_page', 10);
        $status = FHtml::getRequestParam('status','');

        if (strlen($seller_id) == 0 || strlen($status) == 0) {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $recordPerPage = $number_per_page;

        // 26/8/19
        // check is seller - seller_id in product_deal
        // $id_seller = ProductDeal::find()
        //     ->select(['product_deal.seller_id'])
        //     ->groupBy('product_deal.seller_id')
        //     ->all();

        // $arr_id = array();

        // foreach($id_seller as $id)
        // {
        //     $arr_id[] = $id->seller_id;
        // }
        
        

        // if(in_array($seller_id, $arr_id))
         $id_seller = ProductDeal::findOne(['seller_id' => $seller_id]);

        if(isset($seller_id))
        {
            // 26/8
            // $total = OrderDetailAPI::find()
            // ->innerJoin('order', 'order.id = order_detail.orderId')
            // ->where(['seller_id' => $seller_id])
            // ->andWhere(['order.status' => $status])
            // ->count();

            // $total_page = ceil($total / $recordPerPage);
            // $start_index = $page * $recordPerPage - $recordPerPage;

            // $products = OrderDetailAPI::find()
            // ->innerJoin('order', 'order.id = order_detail.orderId')
            // ->where(['seller_id' => $seller_id])
            // ->andWhere(['order.status' => $status])
            // ->limit($recordPerPage)
            // ->offset($start_index)
            // ->all();
            
            // added 26/8
            $total = OrderDetailAPI::find()
            ->innerJoin('order', 'order.id = order_detail.orderId')
            ->innerJoin('product_deal', 'product_deal.id = order_detail.productId')
            ->where(['product_deal.seller_id' => $seller_id])
            ->andWhere(['order.status' => $status])
            ->count();

            $total_page = ceil($total / $recordPerPage);
            $start_index = $page * $recordPerPage - $recordPerPage;

            $products = OrderDetailAPI::find()
            ->innerJoin('order', 'order.id = order_detail.orderId')
            ->innerJoin('product_deal', 'product_deal.id = order_detail.productId')
            ->where(['product_deal.seller_id' => $seller_id])
            ->andWhere(['order.status' => $status])
            ->limit($recordPerPage)
            ->offset($start_index)
            ->all();

            return Response::getOutputForAPI($products, \Globals::SUCCESS, 'OK', ['code'=> 200], $total_page*1);
        }

        return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, 'Seller does not exist', ['code'=> 200], '');
    }
}