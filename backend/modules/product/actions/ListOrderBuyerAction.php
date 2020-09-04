<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\object\models\ObjectCategoryAPI;
use backend\modules\product\models\OrderAPI;
use backend\modules\product\models\OrderDetailAPI;
use common\components\FHtml;
use common\components\Response;
use \stdClass;

class ListOrderBuyerAction extends BaseAction
{
    public function run()
    {
        // ListProductBuyerBought is a child of this
        $buyer_id = FHtml::getRequestParam('buyer_id', '');
        $status = FHtml::getRequestParam('status', '');
        $page = FHtml::getRequestParam('page', 1);
        $number_per_page = FHtml::getRequestParam('number_per_page', 10);

        if (strlen($buyer_id) == 0 || strlen($status) == 0) {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $recordPerPage = $number_per_page;

        $total = OrderDetailAPI::find()
            ->innerJoin('order', 'order.id = order_detail.orderId')
            ->where(['user_id' => $buyer_id])
            ->andWhere(['order.status' => $status])
            ->count();

        $total_page = ceil($total / $recordPerPage);
        $start_index = $page * $recordPerPage - $recordPerPage;

        $products = OrderDetailAPI::find()
            ->innerJoin('order', 'order.id = order_detail.orderId')
            ->where(['user_id' => $buyer_id])
            ->andWhere(['order.status' => $status])
            ->limit($recordPerPage)
            ->offset($start_index)
            ->all();

        return Response::getOutputForAPI($products, \Globals::SUCCESS, 'OK', ['code'=> 200], $total_page);
    }
}