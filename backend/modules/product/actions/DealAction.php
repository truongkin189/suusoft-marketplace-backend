<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\models\Setting;
use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserProAPI;
use backend\modules\app\models\AppUserFavouriteAPI;
use backend\modules\app\models\AppUserTransactionAPI;
use backend\modules\product\models\ProductDealAPI;
use backend\modules\subscribe\models\SubscribeAPI;
use common\components\FHtml;
use common\components\Response;
use Imagine\Image\Box;
use Yii;
use yii\imagine\Image;

use backend\modules\product\models\ProductDealImage;

class DealAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $check = AppUserAPI::findOne($user_id);

        // if (isset($check->pro)) {
        if (true) {
            $deal_id = FHtml::getRequestParam('deal_id', '');
            $action = FHtml::getRequestParam('action', ''); //create/update/delete/online
            $name = FHtml::getRequestParam('name', '');
            $description = FHtml::getRequestParam('description', '');
            $content = FHtml::getRequestParam('content', '');
            $category_id = FHtml::getRequestParam('category_id', '');
            // $category_sub_id = FHtml::getRequestParam('category_sub_id', ''); //chua lam
            $price = FHtml::getRequestParam('price', 0);
            $discount = FHtml::getRequestParam('discount', 0);
            $discount_type = FHtml::getRequestParam('discount_type', ''); //% or amount
            $address = FHtml::getRequestParam('address', '');
            $lat = FHtml::getRequestParam('lat', '');
            $long = FHtml::getRequestParam('long', '');
            $is_premium = FHtml::getRequestParam('is_premium', ''); // 1 / 0
            $is_renew = FHtml::getRequestParam('is_renew', ''); // 1 / 0
            $duration = FHtml::getRequestParam('duration', ''); // hours
            // $image_file = isset($_FILES['image']) ? $_FILES['image'] : null;
            $image_file_1 = isset($_FILES['image1']) ? $_FILES['image1'] : null;
            $image_file_2 = isset($_FILES['image2']) ? $_FILES['image2'] : null;
            $image_file_3 = isset($_FILES['image3']) ? $_FILES['image3'] : null;
            $image_file_4 = isset($_FILES['image4']) ? $_FILES['image4'] : null;
            $attachment_file = isset($_FILES['attachment']) ? $_FILES['attachment'] : null;
            
            $quantity = FHtml::getRequestParam('quantity', '');

            // if (
            //     strlen($action) == 0
            //     ||
            //     (
            //             $action == \Globals::ACTION_CREATE
            //             AND (strlen($name) == 0
            //             || strlen($category_id) == 0
            //             || strlen($quantity) == 0
            //         )
            //     )
            //     || (
            //         $action != \Globals::ACTION_CREATE
            //         && strlen($deal_id) == 0
            //     )
                

            // ) {
            //     return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
            // }


            if (strlen($action != \Globals::ACTION_CREATE) != 0) {
                $deal = ProductDealAPI::findOne($deal_id);
                if (!isset($deal)) {
                    return Response::getOutputForAPI('', \Globals::ERROR, 'Deal not found', ['code' => 241]);
                }
            } else {
                $deal = new ProductDealAPI();
                $deal->reservation_count = 0;
            }


            if ($action == \Globals::ACTION_DELETE) {
                $deal->is_active = \Globals::STATE_DELETED;
            } else {
                if ($action == \Globals::ACTION_CREATE)
                    $deal->is_active = \Globals::STATE_INACTIVE;
            }
            if ($action == \Globals::ACTION_CREATE || $action == \Globals::ACTION_UPDATE) {
                $deal->name = $name;
                $deal->description = $description;
                $deal->content = $content;
                $deal->image = '';
                $deal->address = $address;
                $deal->lat = $lat;
                $deal->long = $long;
                $deal->price = $price;
                $discount_price = 0;
                if (strlen($price) != 0) {
                    if (strlen($discount_type) != 0) {
                        if ($discount_type == 'percent')
                        {
                            $deal->discount_rate = $discount;
                            $deal->discount = '';
                            $discount_price = $discount * $price / 100;
                        }
                        if ($discount_type == 'amount') {
                            $deal->discount = $discount;
                            $deal->discount_rate = '';
                            $discount_price = $discount;
                        }
                    }
                }
				$deal->discount_type = $discount_type;
                $deal->sale_price = $price - $discount_price;
                $deal->is_premium = $is_premium;
                $deal->category_id = $category_id;
                $deal->seller_id = $user_id;
                $deal->is_renew = $is_renew;
            }

            $now = time();
            $today = date('Y-m-d H:i:s', $now);


            if ($action == \Globals::ACTION_CREATE) {
                $deal->created_date = $today;
                $deal->modified_date = $today;
                $deal->created_user = $user_id;
                $deal->quantity = $quantity;
            } else {
                $deal->modified_date = $today;
                $deal->modified_user = $user_id;
            }

            $balance = $check->balance;
            $online_fee = 0;

            if (strlen($duration) != 0) {
                if ($is_premium == 1) {
                    $deal_online_rate = Setting::getSettingValueByKey(\Globals::PREMIUM_DEAL_ONLINE_RATE);
                } else {
                    $deal_online_rate = Setting::getSettingValueByKey(\Globals::DEAL_ONLINE_RATE);
                }
                $online_fee = $deal_online_rate * $duration;
                if ($check->balance < $online_fee) {
                    return Response::getOutputForAPI('', \Globals::ERROR, 'Your account balance is not enough to do this action', ['code' => 230]);
                }

                $old_started = $deal->online_started;
                $old_duration = $deal->online_duration;
                $old_end = $old_started + $old_duration * 3600;
                if ($now < $old_end) {
                    $deal->online_duration = $old_duration + $duration;
                } else {
                    $deal->online_started = $now;
                    $deal->online_duration = $duration;
                }
                $deal->is_online = \Globals::STATE_ACTIVE;

            }

            $file_path = \Yii::getAlias('@' . UPLOAD_DIR) . '/' . PRODUCT_DEAL_DIR . '/';
            $imageName = '';
            $attachmentName = '';
            $upload = false;
            $uploadAttachment = false;

            $oldImage = $deal->image;
            $oldAttachment = $deal->attachment;

            if (isset($attachment_file)) {
                $ext = pathinfo($attachment_file['name'], PATHINFO_EXTENSION);

                $attachmentName = $now . 'attachment.' . $ext;
                $attachment_path = $file_path . $attachmentName;
                $uploadAttachment = move_uploaded_file($attachment_file['tmp_name'], $attachment_path);
                if ($uploadAttachment) {
                    $deal->attachment = $attachmentName;
                }
            }
            

            if ($deal->save(false)) {
                
                $subscribe = SubscribeAPI::find()->where(['subscribed_id' => $user_id])->all();

                $arr_push = array();

                foreach($subscribe as $sub)
                {
                    $arr_push[] = $sub->subscriber_id;
                }
                
                // cmt 27/8
                foreach ($arr_push as $id)
                {
                        $url = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotificationMarket',
                        'msg' => 'Your seller you have subscribed has a new product',
                        'destination_id' => $id,
                        // 'arr_push' => $arr_push
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
                // 29/8/19
                $find_u = AppUserProAPI::findOne($user_id);
                if(!isset($find_u))
                {
                    $app_user_pro = new AppUserProAPI();
                    $app_user_pro->user_id = $user_id;
                    $app_user_pro->is_active = 1;
                    $app_user_pro->save();
                }
                    
                
                
                // if (strlen($duration) != 0) {
                //     $new_balance = $balance - $online_fee;
                //     $check->balance = $new_balance;
                // }
                // if ($check->save()) {
                //     $transaction = new AppUserTransactionAPI();
                //     $transaction->transaction_id = \Globals::generateTransactionId($user_id);
                //     $transaction->user_id = $user_id;
                //     $transaction->user_visible = 1;
                //     $transaction->destination_id = 0;
                //     $transaction->object_id = $deal->id;
                //     $transaction->object_type = \Globals::OBJECT_TYPE_DEAL;
                //     $transaction->amount = $online_fee;
                //     $transaction->currency = 'point';
                //     $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                //     $transaction->time = $now;
                //     $transaction->is_active = 1;
                //     $transaction->action = AppUserTransactionAPI::ACTION_DEAL_ONLINE;
                //     $transaction->type = AppUserTransactionAPI::TYPE_MINUS;
                //     $transaction->created_date = $today;
                //     $transaction->created_user = $user_id;
                //     $transaction->save();
                // }


                // anh
                // sieu sieu moi 19/8/19
                for($i = 1; $i < 5; $i++)
                {
                    if(isset(${'image_file_'.$i}))
                    {
                        ${'ext'.$i} = pathinfo(${'image_file_'.$i}['name'], PATHINFO_EXTENSION);
                        ${'image_'.$i.'_name'} = $now + $i . '_product_deal_image.' . ${'ext'.$i};

                        ${'image_'.$i.'_path'} = $file_path . ${'image_'.$i.'_name'};

                        $model = new ProductDealImage();
                        $model->product_deal_id = $deal->id;
                        $model->created_at = $today;
                        $model->image = ${'image_'.$i.'_name'};
                        $model->save();

                        move_uploaded_file(${'image_file_'.$i}['tmp_name'], ${'image_'.$i.'_path'});
                    }
                }

                // end xu ly anh

                if ($upload && isset($oldImage)) {
                    if (is_file($file_path . '/' . $oldImage)) {
                        unlink($file_path . '/' . $oldImage);
                    }
                    if (is_file($file_path . '/thumb' . $oldImage)) {
                        unlink($file_path . '/thumb' . $oldImage);
                    }
                }
                if ($uploadAttachment && isset($oldAttachment)) {
                    if (is_file($file_path . '/' . $oldAttachment)) {
                        unlink($file_path . '/' . $oldAttachment);
                    }
                }

                // $deal->balance = $check->balance;
                
                if ($action == \Globals::ACTION_CREATE) {
                    if ($deal->is_premium == 1) {
                        $msg = Yii::t('common', 'push.new.deal') . ' ' . $name;
                        $url = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotification',
                            'msg' => $msg,
                            'lat' => $lat,
                            'long' => $long,
                            'type' => 'deal',
                            'category_id' => $category_id,
                            'ignore_user_id' => $user_id,
                            'additional_data' => $deal->id
                        ]);

                        ignore_user_abort(true); // CAUTION!  run over return
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // comment when test
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Skip receive return
                        curl_exec($ch);
                        curl_close($ch);
                    }
                }
				
				$favourites = AppUserFavouriteAPI::find()->where("user_id = $user_id AND object_type = 'deal'")->all();
                $favourite_ids = array();
                foreach ($favourites as $favourite) {
                    $favourite_ids[] = $favourite->object_id;
                }
				
                $deal->is_favourite = in_array($deal->id, $favourite_ids) ? 1 : 0;

                return Response::getOutputForAPI(
                    $deal,
                    \Globals::SUCCESS, 'OK', ['code' => 200]);
            } else {

                if (isset($image_file)) {
                    if ($upload && strlen($imageName) != 0) {
                        if (is_file($file_path . '/' . $imageName)) {
                            unlink($file_path . '/' . $imageName);
                        }
                        if (is_file($file_path . '/thumb' . $imageName)) {
                            unlink($file_path . '/thumb' . $imageName);
                        }
                    }
                }
                if (isset($attachment_file)) {
                    if ($uploadAttachment && strlen($attachmentName) != 0) {
                        if (is_file($file_path . '/' . $attachmentName)) {
                            unlink($file_path . '/' . $attachmentName);
                        }
                    }
                }

                $errors = $deal->getErrors();
                $error_message = Response::getErrorMessage($errors);
                return Response::getOutputForAPI('', \Globals::ERROR, $error_message, ['code' => 203]);
            }
        } else {
            return Response::getOutputForAPI('', \Globals::ERROR, 'Please update your business profile first', ['code' => 231]);

        }
    }
}

