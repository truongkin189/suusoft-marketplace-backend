<?php
namespace backend\actions;

use backend\modules\app\models\AppUserDeviceAPI;
use backend\modules\app\models\AppUserDevice;
use backend\modules\app\models\AppUserAPI;
use backend\modules\product\models\ProductDealAPI;
use backend\modules\product\models\ProductDeal;
use common\components\FHtml;
use yii\db\Expression;
use common\components\Response;


class PushNotificationMarketAction extends BaseAction
{
    public function run()
    {
        //http://www.yiiframework.com/wiki/780/drills-search-by-a-has_many-relation-in-yii-2-0/

        $message = FHtml::getRequestParam('msg', '');

        // for specific user (seller/buyer)
        $each_id = FHtml::getRequestParam('destination_id', '');

        // for all seller/buyer buyer - 1; seller - 0
        $user_type = FHtml::getRequestParam('user_type');

        // msg
        $additional_data = FHtml::getRequestParam('additional_data', '');
        
        // array
        // $arr_push = FHtml::getRequestParam('arr_push', '');
		
        $a_devices = array();
        $i_devices = array();

        if($user_type == '' && $each_id == '')
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        if(strlen($user_type) > 0)
        {
            //for all seller/buyer 

            if($user_type == 0)
            {
                //for all seller using Android device
                $android_devices = AppUserDeviceAPI::find()
                ->innerJoin('product_deal', 'product_deal.seller_id = app_user_device.user_id')
                ->where("app_user_device.type = 1 AND app_user_device.status = 1")->all();

                // for all seller using iOs device
                $ios_devices = AppUserDeviceAPI::find()
                ->innerJoin('product_deal', 'product_deal.seller_id = app_user_device.user_id')
                ->where("app_user_device.type = 2 AND app_user_device.status = 1")->all();

                // return Response::getOutputForAPI($android_devices, \Globals::SUCCESS, 'OK', ['code'=> 200]);
            }
            else
            {
                // for all buyer; $user_type=1
                $id_seller = ProductDeal::find()
                ->select(['product_deal.seller_id'])
                ->groupBy('product_deal.seller_id')
                ->all();

                $arr_id = array();

                foreach($id_seller as $id)
                {
                    $arr_id[] = $id->seller_id;
                }

                $android_devices = AppUserDeviceAPI::find()
                ->where("app_user_device.type = 1 AND app_user_device.status = 1")
                ->andWhere(['NOT IN','app_user_device.user_id',$arr_id])
                ->all();

                $ios_devices = AppUserDeviceAPI::find()
                ->where("app_user_device.type = 2 AND app_user_device.status = 1")
                ->andWhere(['NOT IN','app_user_device.user_id',$arr_id])
                ->all();

            }
        }
        
        if(strlen($each_id) > 0)
        {
            $android_devices = AppUserDeviceAPI::find()
            ->where("user_id = $each_id AND type = 1 AND status = 1")->all();
            // return Response::getOutputForAPI($android_devices, \Globals::SUCCESS, 'OK', ['code'=> 200]);

            $ios_devices = AppUserDeviceAPI::find()
            ->where("user_id = $each_id AND type = 2 AND status = 1")->all();
        }
        
        // else if(isset($arr_push) && !empty($arr_push))
        // {
        //     $android_devices = array();
        //     $ios_devices = array();

        //     foreach($arr_push as $id)
        //     {
        //         $a_temp = AppUserDeviceAPI::find()
        //         ->where("user_id = $each_id AND type = 1 AND status = 1")->all();
        //         array_push($android_devices,$a_temp);
                
        //         $i_temp= AppUserDeviceAPI::find()
        //         ->where("user_id = $each_id AND type = 2 AND status = 1")->all();
        //         array_push($ios_devices,$i_temp);
        //     }
        // }

        foreach ($android_devices as $a) {
            array_push($a_devices, $a->gcm_id);
        }
        foreach ($ios_devices as $i) {
            array_push($i_devices, $i->gcm_id);
        }

        if (count($a_devices) > 0) {
            try {
                \Globals::pushAndroid($a_devices, $message, $type, $additional_data);
            } catch (\Exception $e) {
                 return $e;
            }
        }

        if (count($i_devices) > 0) {
            try {
                \Globals::pushIos($i_devices, $message, $type, $additional_data);
            } catch (\Exception $e) {
                 return $e;
            }
        }
    }
}
