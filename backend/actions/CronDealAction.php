<?php
namespace backend\actions;

use backend\models\Setting;
use backend\modules\app\models\AppUserTransactionAPI;
use backend\modules\product\models\ProductDealAPI;
use common\components\Response;
use Yii;
use yii\db\Exception;

set_time_limit(0);


class CronDealAction extends BaseAction
{
    public function run()
    {
        $now = time();

        $today = date('Y-m-d H:i:s', $now);

        Yii::$app->db->createCommand("UPDATE product_deal SET is_online = 0, online_started = NULL, online_duration= NULL, reservation_count = 0, modified_date = '$today'  
WHERE (online_started + (3600*online_duration)) < :now AND is_renew = 0 AND online_started IS NOT NULL AND online_duration IS NOT NULL")
            ->bindValue(':now', $now)
            ->execute();

        $premium_deal_online_rate = Setting::getSettingValueByKey(\Globals::PREMIUM_DEAL_ONLINE_RATE);
        $deal_online_rate = Setting::getSettingValueByKey(\Globals::DEAL_ONLINE_RATE);

        $others = ProductDealAPI::find()->where("(online_started + (3600*online_duration)) < $now AND is_renew = 1 AND online_started IS NOT NULL AND online_duration IS NOT NULL")->all();

        /* @var $item ProductDealAPI */
        foreach ($others as $item) {
            $is_premium = $item->is_premium;
            if ($is_premium == 1) {
                $online_rate = $premium_deal_online_rate;
            } else {
                $online_rate = $deal_online_rate;
            }
            $reservation_count = $item->reservation_count;
            if($reservation_count == 0){
                $online_fee = 0;
            }else{
                $online_fee = $item->online_duration * $online_rate;
            }

            if ($item->user->balance < $online_fee) {
                $item->online_started = null;
                $item->online_duration = null;
                $item->reservation_count = 0;
                $item->is_online = \Globals::STATE_INACTIVE;
                $item->modified_date = $today;
                $item->save();
            } else {
                $item->online_started = $now;
                $item->reservation_count = 0;
                $item->modified_date = $today;
                if($online_fee !=0){
                    $item->user->balance = $item->user->balance - $online_fee;

                    $safe = true;
                    $connection = \Yii::$app->db;
                    $transaction = $connection->beginTransaction();
                    try {
                        $item->save();
                        if ($item->user->save()) {
                            $user_id = $item->seller_id;
                            $user_transaction = new AppUserTransactionAPI();
                            $user_transaction->transaction_id = \Globals::generateTransactionId($user_id);
                            $user_transaction->user_id = $user_id;
                            $user_transaction->user_visible = 1;
                            $user_transaction->destination_id = 0;
                            $user_transaction->object_id = $item->id;
                            $user_transaction->object_type = \Globals::OBJECT_TYPE_DEAL;
                            $user_transaction->amount = $online_fee;
                            $user_transaction->currency = 'point';
                            $user_transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                            $user_transaction->time = $now;
                            $user_transaction->is_active = 1;
                            $user_transaction->action = AppUserTransactionAPI::ACTION_DEAL_ONLINE;
                            $user_transaction->type = AppUserTransactionAPI::TYPE_MINUS;
                            $user_transaction->created_date = $today;
                            $user_transaction->created_user = $user_id;
                            if ($user_transaction->save()) {
                                $transaction->commit();
                            } else {
                                $safe = false;
                            }
                        } else {
                            $safe = false;
                        }
                        if (!$safe) {
                            $transaction->rollBack();
                            $item->online_started = null;
                            $item->online_duration = null;
                            $item->reservation_count = 0;
                            $item->is_online = \Globals::STATE_INACTIVE;
                            $item->modified_date = $today;
                            $item->save();
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        $item->online_started = null;
                        $item->online_duration = null;
                        $item->reservation_count = 0;
                        $item->is_online = \Globals::STATE_INACTIVE;
                        $item->modified_date = $today;
                        $item->save();
                    }
                }else{
                    $item->save();
                }

            }
        }
    }
}
