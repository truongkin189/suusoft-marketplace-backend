<?php
namespace backend\modules\app\actions;

use backend\actions\BaseAction;
use backend\models\Setting;
use backend\modules\app\models\AppUserTransactionAPI;
use common\components\FHtml;
use common\components\Response;
use Yii;

class AccountingAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;

        $user_id = $this->user_id;

        $type = FHtml::getRequestParam('type', ''); //deal/trip

        if(strlen($type) == 0){
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $year = date('Y');
        $start = mktime(0, 0, 0, 1, 1, $year);
        $end = mktime(23, 59, 59, 12, 31, $year);

        $transactions = AppUserTransactionAPI::find()->where("object_type = '$type' AND (user_id =  $user_id OR destination_id = $user_id) AND (object_type = 'deal' OR object_type = 'trip')  AND `time` > $start and `time` < $end ")->all();

        $data = array();
        /* @var AppUserTransactionAPI $item*/

        $key_trip = 'trip-payment-commission';
        $commission_trip = Yii::$app->cache->get($key_trip);
        if($commission_trip == false){
            $commission_trip =  Setting::getSettingValueByKey(\Globals::TRIP_PAYMENT_FEE);
            Yii::$app->cache->set($key_trip, $commission_trip, 3600);
        }

        $key_deal = 'deal-payment-commission';
        $commission_deal = Yii::$app->cache->get($key_deal);
        if($commission_deal == false){
            $commission_deal =  Setting::getSettingValueByKey(\Globals::DEAL_PAYMENT_FEE);
            Yii::$app->cache->set($key_deal, $commission_deal, 3600);
        }

        foreach($transactions as $item){
            $month = (int) date('m',$item->time);
            $data[$month]['month'] = $month;
            $old_revenue = isset($data[$month]['revenue'])? $data[$month]['revenue'] : 0 ;
            $old_expense = isset($data[$month]['expense'])? $data[$month]['expense'] : 0 ;
            if($item->user_id == $user_id){
                if($item->type == AppUserTransactionAPI::TYPE_PLUS){
                    $data[$month]['revenue'] = $old_revenue + $item->amount;
                    $data[$month]['expense'] = $old_expense;
                }
                if($item->type == AppUserTransactionAPI::TYPE_MINUS){
                    $data[$month]['revenue'] = $old_revenue;

                    if($item->destination_id != 0){
                        if($item->object_type == \Globals::OBJECT_TYPE_TRIP){
                            $commission_fee = $commission_trip;
                        }
                        elseif($item->object_type == \Globals::OBJECT_TYPE_DEAL){
                            $commission_fee = $commission_trip;
                        }else{
                            $commission_fee = 0;
                        }
                        $data[$month]['expense'] = $old_expense + $item->amount+$commission_fee;

                    }else{
                        $data[$month]['expense'] = $old_expense + $item->amount;
                    }

                }
            }
            if($item->destination_id == $user_id){
                if($item->type == AppUserTransactionAPI::TYPE_MINUS){
                    $data[$month]['revenue'] = $old_revenue + $item->amount;
                }
            }

        }

        for ($i=1; $i<=12; $i++){
            if(!array_key_exists ($i,$data)){
                $data[$i] = array('month'=> $i, 'revenue'=> 0, 'expense'=> 0);
            }
        }
        ksort($data);
        $data = array_values($data);
        return Response::getOutputForAPI($data, \Globals::SUCCESS, 'OK', ['code' => 200]);
    }
}
