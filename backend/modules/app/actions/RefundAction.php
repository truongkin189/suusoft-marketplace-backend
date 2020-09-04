<?php
namespace backend\modules\app\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\appuserrefund\AppUserRefundRequest;
use common\components\FHtml;
use common\components\Response;
use Yii;

/* @var $check AppUserAPI*/

class RefundAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        // if (($re = $this->isAuthorized())!== true)
        //     return $re;

        $seller_id = FHtml::getRequestParam('seller_id', '');
        $buyer_id = FHtml::getRequestParam('buyer_id', '');
        $order_id = FHtml::getRequestParam('order_id', '');
        $product_id = FHtml::getRequestParam('product_id', '');
        // how much ??
        $amount = FHtml::getRequestParam('amount', '');
        // refund methods: point, transfer, etc
        $type = FHtml::getRequestParam('refund_method', 'point');
        $note = FHtml::getRequestParam('note', '');

        // $user_id = $this->user_id;

        // CHUA XU LY

        if(
            strlen($seller_id) == 0 || strlen($buyer_id) == 0 || strlen($order_id) == 0
            || strlen($product_id) == 0 || strlen($amount) == 0 || strlen($type) == 0 
        )
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $model = new AppUserRefundRequest();

        $model->buyer_id = $buyer_id;
        $model->seller_id = $seller_id;
        $model->order_id = $order_id;
        $model->product_id = $product_id;
        $model->amount = $amount;
        $model->status = 0;
        $model->type = $type;
        $model->note = $note;
        $time_string = time();
        $model->created_at = date('Y-m-d H:i:s', $time_string);


        if($model->save())
        {

            // push notification to seller
            $msg = $model->note;
            // $msg = Yii::t('common', 'push.redeem.approved');

            $url = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                'msg' => $msg,
                'destination_id' => $model->seller_id,
                // empty
                // 'additional_data' => $user_transaction->user->balance,
            ]);
            // CURL init
            $ch = curl_init();
            // CURL config
            curl_setopt($ch, CURLOPT_URL, $url);
            // CURL run
            curl_exec($ch);
            // CURL close
            curl_close($ch);

            return Response::getOutputForAPI($data, \Globals::SUCCESS, 'OK', ['code'=> 200]);
        }
        
    }

}
