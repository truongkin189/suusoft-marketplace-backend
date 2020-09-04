<?php
namespace backend\actions;

use backend\modules\app\models\AppUserDeviceAPI;
use common\components\FHtml;
use yii\db\Expression;


class PushNotificationAction extends BaseAction
{
    public function run()
    {
        //http://www.yiiframework.com/wiki/780/drills-search-by-a-has_many-relation-in-yii-2-0/

        $message = FHtml::getRequestParam('msg', '');
        $type = FHtml::getRequestParam('type', '');
        $category_id = FHtml::getRequestParam('category_id', '');
        $lat = FHtml::getRequestParam('lat', '');
        $long = FHtml::getRequestParam('long', '');
        $user_id = FHtml::getRequestParam('user_id', '');
        $ignore_user_id = FHtml::getRequestParam('ignore_user_id', '');
        $additional_data = FHtml::getRequestParam('additional_data', '');
		
        $a_devices = array();
        $i_devices = array();

        if(strlen($user_id) == 0  or $user_id ==0){
            if($type == \Globals::OBJECT_TYPE_DEAL && strlen($category_id)!=0 ){
                $keyword = \Globals::getCategoryKeyword($category_id);
                if(strlen($keyword)!=0){
                    if(strlen($lat)!=0 AND strlen($long)!=0){
                        $distance = 1;

                        $extend_condition = new Expression(" AND `app_user_device`.`user_id` IN (select id FROM (SELECT *, (((acos(sin(($lat*pi()/180)) *
                    sin((`lat`*pi()/180))+cos(($lat*pi()/180)) *
                    cos((`lat`*pi()/180)) * cos((($long-`long`)*pi()/180))))*180/pi())*60*1.1515*1.609344)
            as distance
            FROM `app_user`) place WHERE distance <= $distance)");
                    }else{
                        $extend_condition = "";
                    }
                    if(strlen($ignore_user_id)!=0){
                        $extend_condition_2 = " AND `app_user_device`.`user_id` != $ignore_user_id";
                    }else{
                        $extend_condition_2 = "";
                    }
                    $android_devices = AppUserDeviceAPI::find()->joinWith('setting')->where("type = 1 AND status = 1 AND notify = 1 AND notify_$keyword = 1".$extend_condition.$extend_condition_2)->all();
                    $ios_devices = AppUserDeviceAPI::find()->joinWith('setting')->where("type = 2 AND status = 1 AND notify = 1 AND notify_$keyword = 1".$extend_condition.$extend_condition_2)->all();
                }else{
                    die;
                }
            }
            else{
                $android_devices = AppUserDeviceAPI::find()->where("type = 1 AND status = 1")->all();
                $ios_devices = AppUserDeviceAPI::find()->where("type = 2 AND status = 1")->all();
            }
        }else{
            $android_devices = AppUserDeviceAPI::find()->where("user_id = $user_id AND type = 1 AND status = 1")->all();
            $ios_devices = AppUserDeviceAPI::find()->where("user_id = $user_id AND type = 2 AND status = 1")->all();
        }

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
