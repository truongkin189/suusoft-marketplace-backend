<?php

namespace backend\modules\product\actions;


use backend\actions\BaseAction; 
use backend\modules\product\models\Order;
use backend\modules\product\models\OrderDetail;
use backend\modules\coupon\models\Coupon;
use backend\modules\product\models\ProductDealAPI;
use backend\modules\app\models\AppUserTransactionAPI;
use backend\modules\app\models\User;
use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUser;
use common\components\FHtml;
use common\widgets\FActiveForm;
// use backend\modules\app\models\AppUserLogs;
use common\components\FConstant;
use backend\models\Setting;
use common\components\Response;
use Yii;

class OrderAction extends BaseAction
{
    public $is_secured = false;
    public function run()
    {

    		$type_product = isset($_REQUEST['type_product']) ? $_REQUEST['type_product'] : "";

            $billingName = isset($_REQUEST['billingName']) ? $_REQUEST['billingName'] : "";
            $billingAddress = isset($_REQUEST['billingAddress']) ? $_REQUEST['billingAddress'] : "";
            $billingPhone = isset($_REQUEST['billingPhone']) ? $_REQUEST['billingPhone'] : "";
            $billingEmail = isset($_REQUEST['billingEmail']) ? $_REQUEST['billingEmail'] : "";
            $billingPostcode = isset($_REQUEST['billingPostcode']) ? $_REQUEST['billingPostcode'] : "";

            $shippingName = isset($_REQUEST['shippingName']) ? $_REQUEST['shippingName'] : "";
            $shippingAddress = isset($_REQUEST['shippingAddress']) ? $_REQUEST['shippingAddress'] : "";
            $shippingPhone = isset($_REQUEST['shippingPhone']) ? $_REQUEST['shippingPhone'] : "";
            $shippingEmail = isset($_REQUEST['shippingEmail']) ? $_REQUEST['shippingEmail'] : "";
            $shippingPostcode = isset($_REQUEST['shippingPostcode']) ? $_REQUEST['shippingPostcode'] : "";

            $paymentMethod = FHtml::getRequestParam('paymentMethod', '');
            $content = isset($_REQUEST['content']) ? $_REQUEST['content'] : "";
            $vat = isset($_REQUEST['vat']) ? $_REQUEST['vat'] : 0;
            $transportType = isset($_REQUEST['transportType']) ? $_REQUEST['transportType'] : '';
            $transportDes = isset($_REQUEST['transportDes']) ? $_REQUEST['transportDes'] : '';
            $transportFee = isset($_REQUEST['transportFee']) ? $_REQUEST['transportFee'] : 0;
            $total = isset($_REQUEST['total']) ? $_REQUEST['total'] : 0;
            $items = isset($_REQUEST['items']) ? $_REQUEST['items'] : '';
            $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : ''; //nguoi mua
            //new
            $size = isset($_REQUEST['size']) ? $_REQUEST['size'] : "";
            $color = isset($_REQUEST['color']) ? $_REQUEST['color'] : "";
            
            // 24/8
            $coupon = isset($_REQUEST['coupon']) ? $_REQUEST['coupon'] : '';
            
            
            if (strlen($user_id) == 0 || strlen($items) == 0) {
                return FHtml::getOutputForAPI('', \Globals::ERROR, 'Missing params', [], 1);
            }
            
            $now = time();
            $today = date('Y-m-d H:i:s', $now);
            
            $admin = User::findOne(['username' => 'admin']);
            
            $ha = json_decode($items);
            
            // commission_rate
            $commission = Setting::getSettingValueByKey(\Globals::COMMISSION_RATE);
            
            // add 26/8
            // tru tien buyer
            if(strcmp($paymentMethod,'point') == 0)
            {
                $check_balance_buyer = AppUser::findOne($user_id);
                
                if($check_balance_buyer->balance < $total)
                {
                    return Response::getOutputForAPI('', \Globals::ERROR, 'Your balance not enough. Please choose another payment method!', ['code'=> 134], '');
                }
                else
                {
                    // minus buyer's balance
                    $check_balance_buyer->balance -= $total;
                    $check_balance_buyer->save(false);
                    
                    // create transaction for it
                    $transaction = new AppUserTransactionAPI();
                    $transaction->transaction_id = \Globals::generateTransactionId($user_id);
                    $transaction->user_id = $user_id;
                    $transaction->user_visible = 1;
                    // $transaction->destination_id = -1;
                    // $transaction->object_id = $deal->id;
                    $transaction->object_type = \Globals::OBJECT_TYPE_DEAL;
                    $transaction->amount = $total;
                    $transaction->currency = 'point';
                    $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                    $transaction->time = $now;
                    $transaction->is_active = 1;
                    $transaction->action = 'order';
                    $transaction->type = AppUserTransactionAPI::TYPE_MINUS;
                    $transaction->created_date = $today;
                    $transaction->created_user = $check_balance_buyer->username;
                    $transaction->save();
                    

                    // foreach ($ha as $item)
                    // {
                    //     $seller = AppUser::findOne($item->{'sellerId'});
                    //     $seller->balance += $item->{'price'};
                    //     $seller->save(false);
                        
                    //     // 4/9/19
                    //     $transaction = new AppUserTransactionAPI();
                    //     $transaction->transaction_id = \Globals::generateTransactionId($admin->id);
                    //     $transaction->user_id = $admin->id;
                    //     $transaction->user_visible = 1;
                    //     $transaction->destination_id = $seller->id;
                    //     // $transaction->object_id = $deal->id;
                    //     $transaction->object_type = \Globals::OBJECT_TYPE_SELL;
                    //     $transaction->amount = $total;
                    //     $transaction->currency = 'point';
                    //     $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                    //     $transaction->time = $now;
                    //     $transaction->is_active = 1;
                    //     $transaction->action = AppUserTransactionAPI::ACTION_DEAL_ONLINE;
                    //     $transaction->type = AppUserTransactionAPI::TYPE_PLUS;
                    //     $transaction->created_date = $today;
                    //     $transaction->created_user = $admin->username;
                    //     $transaction->save();
                    // }
                }

            }
            // end 26/8
            
            // created 19/8/19, updated 29/8
            // cong tien hang cho seller va tru hoa hong
            $list_seller_id = array();
            $seller_money = array();

            foreach ($ha as $item)
            {
                if(!in_array($item->{'sellerId'},$list_seller_id))
                {
                    $seller_money[$item->{'sellerId'}] = 0;
                    // khoi tao
                    $seller_money[$item->{'sellerId'}] = $item->{'totalMoney'};
                    // chua co trong arr
                    array_push($list_seller_id,$item->{'sellerId'});

                    // $seller = AppUser::findOne(['id' => $item->{'sellerId'}]);
                    // $seller->balance -= $commission/100*$total;
                    // // $seller->balance += $item->{'price'} - $commission/100*$total;
                    // $seller->save();
                    
                    // // 4/9/19
                        // $transaction = new AppUserTransactionAPI();
                        // $transaction->transaction_id = \Globals::generateTransactionId($admin->id);
                        // $transaction->user_id = $admin->id;
                        // $transaction->user_visible = 1;
                        // $transaction->destination_id = $seller->id;
                        // // $transaction->object_id = $deal->id;
                        // $transaction->object_type = \Globals::COMMISSION_RATE;
                        // $transaction->amount = $commission/100*$totall;
                        // $transaction->currency = 'point';
                        // $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                        // $transaction->time = $now;
                        // $transaction->is_active = 1;
                        // $transaction->action = AppUserTransactionAPI::ACTION_DEAL_ONLINE;
                        // $transaction->type = AppUserTransactionAPI::TYPE_PLUS;
                        // $transaction->created_date = $today;
                        // $transaction->created_user = $admin->username;
                        // $transaction->save();
                    // end
                }
                else
                {
                    $seller_money[$item->{'sellerId'}] += $item->{'totalMoney'};
                }
            }
            // end 19/8/19 update 29/8
            
            // 29/8
            foreach ($seller_money as $seller_id=>$seller_value)
            {
                $seller = AppUser::findOne(['id' => $seller_id]);
         
                $seller->balance += $seller_value - ($commission/100)*$seller_value;
                
                
            
                if($seller->save())
                {
                    // transaction tru hoa hong seller
                        $transaction = new AppUserTransactionAPI();
                        $transaction->transaction_id = \Globals::generateTransactionId($admin->id);
                        $transaction->user_id = $admin->id;
                        $transaction->user_visible = 1;
                        $transaction->destination_id = $seller->id;
                        // $transaction->object_id = $deal->id;
                        $transaction->object_type = \Globals::COMMISSION_RATE;
                        $transaction->amount = ($commission/100)*$seller_value;
                        $transaction->currency = 'point';
                        $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                        $transaction->time = $now;
                        $transaction->is_active = 1;
                        $transaction->action = AppUserTransactionAPI::ACTION_DEAL_ONLINE;
                        $transaction->type = AppUserTransactionAPI::TYPE_MINUS;
                        $transaction->created_date = $today;
                        $transaction->created_user = $admin->username;
                        $transaction->save();
                        
                        // transaction cong tien hang cho seller
                        $transaction = new AppUserTransactionAPI();
                        $transaction->transaction_id = \Globals::generateTransactionId($admin->id);
                        $transaction->user_id = $admin->id;
                        $transaction->user_visible = 1;
                        $transaction->destination_id = $seller->id;
                        // $transaction->object_id = $deal->id;
                        $transaction->object_type = \Globals::OBJECT_TYPE_SELL;
                        $transaction->amount = $seller_value;
                        $transaction->currency = 'point';
                        $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                        $transaction->time = $now;
                        $transaction->is_active = 1;
                        $transaction->action = AppUserTransactionAPI::ACTION_DEAL_ONLINE;
                        $transaction->type = AppUserTransactionAPI::TYPE_PLUS;
                        $transaction->created_date = $today;
                        $transaction->created_user = $admin->username;
                        $transaction->save();
                }
            }
            // end 29/8
            
            // 24/8/19
            $coupon = Coupon::findOne(['code' => $coupon]);
            
            if(isset($coupon))
            {
                $refund_amount = $coupon->discount_amount;
                
                $app_user = AppUser::findOne($user_id);
                $app_user->balance += $refund_amount;
                
                if($app_user->save(false))
                {
                    $transaction = new AppUserTransactionAPI();
                    $transaction->transaction_id = \Globals::generateTransactionId($admin->id);
                    $transaction->user_id = $admin->id;
                    $transaction->user_visible = 1;
                    $transaction->destination_id = $user_id;
                    // $transaction->object_id = $deal->id;
                    $transaction->object_type = \Globals::OBJECT_TYPE_DEAL;
                    $transaction->amount = $refund_amount;
                    $transaction->currency = 'point';
                    $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                    $transaction->time = $now;
                    $transaction->is_active = 1;
                    $transaction->action = AppUserTransactionAPI::ACTION_DEAL_ONLINE;
                    $transaction->type = AppUserTransactionAPI::TYPE_PLUS;
                    $transaction->created_date = $today;
                    $transaction->created_user = $admin->username;
                    $transaction->save();

                    // push
                    $url = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                    'msg' => 'Your coupon added successfully. Your balance is added ' . $refund_amount,
                    'destination_id' => $user_id,
                    // empty
                    'additional_data' => $app_user->balance,
                    ]);
                    // CURL init
                    $ch = curl_init();
                    // CURL config
                    curl_setopt($ch, CURLOPT_URL, $url);
                    // CURL run
                    curl_exec($ch);
                    // CURL close
                    curl_close($ch);
                    // end push
                }
                
                
            }
            // 24/8/19

            $order = new Order();

            $order->type_product = $type_product;
            $order->billingName = $billingName;
            $order->billingAddress = $billingAddress;
            $order->billingPhone = $billingPhone;
            $order->billingEmail = $billingEmail;
            $order->billingPostcode = $billingPostcode;


            $order->shippingName = $shippingName;
            $order->shippingAddress = $shippingAddress;
            $order->shippingPhone = $shippingPhone;
            $order->shippingEmail = $shippingEmail;
            $order->shippingPostcode = $shippingPostcode;

            $order->paymentMethod = $paymentMethod;
            $order->content = $content;
            $order->vat = $vat;
            $order->transportFee = $transportFee;
            $order->transportDes = $transportDes;
            $order->transportType = $transportType;
            $order->status = 0;
            $order->status_user = 0;
            $order->total = $total;
            $order->user_id = $user_id;
            if($order->save()){
                $ha = json_decode($items);

                foreach ($ha as $item) {
                    $price = $item->{'price'};             

                    $orderDetail = new OrderDetail();
                    $orderDetail->orderId = $order->id;
                    $orderDetail->quantity = $item->{'number'};
                    $orderDetail->productId = $item->{'id'};
                    $orderDetail->productName = $item->{'title'};
                    $orderDetail->price = $price;
                    $orderDetail->subTotal = $item->{'number'} * $price;
                    $orderDetail->startDate = '';
                    $orderDetail->endDate = '';
                    $orderDetail->color = $item->{'color'};
                    $orderDetail->size= $item->{'size'};    
           
                    if($orderDetail->save())
                    {
                        
                        $product_deal = ProductDealAPI::findOne($item->{'id'});
                        $product_deal->quantity -= $item->{'number'};
                        // if($product_deal->quantity == 0)
                        // {
                        //     $product_deal->is_active = 0;
                        // }
                        $product_deal->save();
                    }
                    else
                    {
                        var_dump($orderDetail->getErrors());
                        exit;
                        return FHtml::getOutputForAPI($order->getErrors(), \Globals::ERROR, 'Can not create order detail', [], 1);
                    }

                }
                
                // return gettype($list_seller_id[0]);
                
                // push notification to seller
                foreach ($list_seller_id as $id_seller)
                {
                    $url = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                        'msg' => 'You have new order',
                        // 'arr_push' => $list_seller_id,
                        'destination_id' => $id_seller,
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
                }
                // end push notification

                //$this->saveChiTieu($user_id, $total);
                $this->saveActivity($user_id, FConstant::TITLE_ACTION_ORDER_NEW,'');

                return FHtml::getOutputForAPI($order, \Globals::SUCCESS, '', ['code'=>200], 1);
            }
    }
}