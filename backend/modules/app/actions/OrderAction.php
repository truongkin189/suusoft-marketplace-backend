<?php
namespace backend\modules\app\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserTokenAPI;
use backend\modules\product\models\Order;
use backend\modules\product\models\OrderDetailAPI;
use common\components\FHtml;
use common\components\Response;
use Yii;

/* @var $check AppUserAPI*/

class OrderAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized())!== true)
            return $re;

        $order_id = FHtml::getRequestParam('order_id', '');
        $new_status= FHtml::getRequestParam('status', '');

        $user_id = $this->user_id;

        //Yii::$app->response->statusCode = 400;

        if(strlen($order_id) == 0 || strlen($new_status) == 0)
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $order = Order::findOne(['id' => $order_id]);
        $order->status = $new_status;
        
        $result = OrderDetailAPI::find()
        ->innerJoin('order', 'order.id = order_detail.orderId')
        ->innerJoin('product_deal', 'product_deal.id = order_detail.productId')
        ->where(['order.id' => $order_id])
        ->all();

        if ($order->save()) {
            return Response::getOutputForAPI($result, \Globals::SUCCESS, 'OK', ['code'=> 200]);
        } else {
            return Response::getOutputForAPI('Order status update fail!', \Globals::ERROR, '', ['code'=> 221]);
        }
    }

}
