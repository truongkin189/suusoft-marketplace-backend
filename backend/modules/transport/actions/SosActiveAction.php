<?php
namespace backend\modules\transport\actions;

use backend\actions\BaseAction;
use backend\models\Setting;
use common\components\FHtml;
use common\components\Response;
use backend\modules\app\models\AppUserDeviceAPI;
use yii\db\Expression;
use backend\modules\transport\models\TransportDriver;

class SosActiveAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
       if (($re = $this->isAuthorized()) !== true)
            return $re;

        $user_id = $this->user_id;

        $type = 'all';
        //$distance = FHtml::getRequestParam('distance', 200); //km
        $start_lat = FHtml::getRequestParam('start_lat', '');
        $start_long = FHtml::getRequestParam('start_long', '');
        $action = FHtml::getRequestParam('action', 'off');

        $driver_search_range = Setting::getSettingValueByKey(\Globals::SEARCHING_DRIVER_DISTANCE);

        if (
           
            //|| strlen($distance) == 0
             strlen($start_lat) == 0
            || strlen($start_long) == 0
        ) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $driver = TransportDriver::find()->where('user_id = '.$user_id)->one();
        if ($action == 'off') {
            
            
            $driver->is_sos = 0;
            $driver->save();

            return Response::getOutputForAPI('', \Globals::SUCCESS, 'OK',
                ['code' => 200]
             ); 
        }else{
            $driver->is_sos = 1;
            $driver->save();
        }
        //$calculation  = TransportHelper::calculateDistance($start_lat, $start_long, $end_lat, $end_long, 'K');
        
        $condition = "place.id != $user_id AND transport_driver.is_active = 1 AND transport_driver.is_online = 1";
        // $condition .= " AND transport_driver.type = 'all'";
        $condition = $condition . " AND distance <= " . $driver_search_range;
         $condition = $condition . " AND app_user_device.type = 1";


        $place_array = array();
        $rows = (new \yii\db\Query())
            ->select(['place.id',
                'email',
                'lat',
                'long',
                'app_user_device.gcm_id',
                'app_user_device.status',
                'app_user_device.type',
            ])
            ->from("
            (SELECT *, (((acos(sin((" . $start_lat . "*pi()/180)) *
                    sin((`lat`*pi()/180))+cos((" . $start_lat . "*pi()/180)) *
                    cos((`lat`*pi()/180)) * cos(((" . $start_long . " -
                            `long`)*pi()/180))))*180/pi())*60*1.1515*1.609344)
            as distance
            FROM `app_user`) place")

            ->where($condition)
            ->join('INNER JOIN', 'app_user_pro', 'place.id = app_user_pro.user_id')
            ->join('INNER JOIN', 'transport_driver', 'place.id = transport_driver.user_id')
             ->join('INNER JOIN', 'app_user_device', 'place.id = app_user_device.user_id')
            ->all();
        

        $a_devices = array();
        $i_devices = array();
        foreach ($rows as $a) {
            if ($a['type'] == '1') {
                    array_push($a_devices, $a['gcm_id']);
                }else{
                  //  array_push($i_devices, $a->gcm_id);
                }
            
        }
       
       $additional_data='';
       $type = 'sos';
       $message = 'SOS';

        if (count($a_devices) > 0) {
            try {
               $data = \Globals::pushAndroid($a_devices, $message, $type, $additional_data);
              
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
