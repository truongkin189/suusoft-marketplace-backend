<?php
namespace backend\modules\transport\actions;

use backend\actions\BaseAction;
use backend\models\Setting;
use common\components\FHtml;
use common\components\Response;


class DriverListAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;

        $user_id = $this->user_id;

        $type = FHtml::getRequestParam('type', 'all'); //taxi,vip,lift,moto,all/delivery
        //$distance = FHtml::getRequestParam('distance', 200); //km
        $start_lat = FHtml::getRequestParam('start_lat', '');
        $start_long = FHtml::getRequestParam('start_long', '');
        $end_lat = FHtml::getRequestParam('end_lat', '');
        $end_long = FHtml::getRequestParam('end_long', '');

        $driver_search_range = Setting::getSettingValueByKey(\Globals::SEARCHING_DRIVER_DISTANCE);

        if (
            strlen($type) == 0
            //|| strlen($distance) == 0
            || strlen($start_lat) == 0
            || strlen($start_long) == 0
        ) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        //$calculation  = TransportHelper::calculateDistance($start_lat, $start_long, $end_lat, $end_long, 'K');

        $condition = "place.id != $user_id AND transport_driver.is_active = 1 AND transport_driver.is_online = 1";

        if (strlen($type) != 0 && $type != 'all') {
            if($type == 'delivery'){
                $condition .= " AND transport_driver.is_delivery = 1";
            }else{
                $condition .= " AND transport_driver.type = '$type'";
            }
        }
        $order = 'app_user_pro.rate DESC';

        $condition = $condition . " AND distance <= " . $driver_search_range;

        $place_array = array();
        $rows = (new \yii\db\Query())
            ->select(['place.id',
                'qb_id',
                'app_user_pro.business_name AS name',
                'email',
                'lat',
                'long',
                'app_user_pro.rate',
                'app_user_pro.rate_count',
                'transport_driver.type',
                'transport_driver.fare',
                'transport_driver.is_sos',
                'transport_driver.is_delivery',
                'app_user_pro.business_phone',
                'app_user_pro.business_email'
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
            ->orderBy($order)
            ->all();

        foreach ($rows as $place) {
            $place_array[] = $place;
        }

        $origin_string = $start_lat.",".$start_long;
        if(strlen($end_lat)!= 0 && strlen($end_long) != 0){
            $destinations = array(
                $end_lat.",".$end_long
            );
        }else{
            $destinations = array(
                $start_lat.",".$start_long
            );
        }


        foreach ($place_array as $item){
            $destinations[] = $item['lat'].",".$item['long'];
        }
        $destination_string = implode('|',$destinations);

        $google_api_key = Setting::getSettingValueByKey(\Globals::GOOGLE_API_KEY);

        $post_data = array(
            'units'=> 'metric',
            'origins'=> $origin_string,
            'destinations' => $destination_string,
            'key' => $google_api_key
        );

        //https://developers.google.com/maps/documentation/distance-matrix/intro
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json"; //Post not working
        $ch = curl_init();
        $url = $url . "?" . http_build_query( $post_data );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
        $output = curl_exec($ch);
        curl_close($ch);

        $distance_to_destination = 0;
        $duration_to_destination = 0;
        $default_value = 0;

        $response_array = json_decode($output,true);

        if(is_array($response_array['rows'][0]['elements'])){
            $result = $response_array['rows'][0]['elements'];
            $destination = array_shift($result);

            if($destination["status"] === "OK"){
                $distance_to_destination = $destination['distance']['value'];
                $duration_to_destination = $destination['duration']['value'];
            }

            for($i = 0; $i < count($place_array) ; $i ++){
                if($result [$i]["status"] === "OK"){
                    $place_array[$i]['distance'] = $result [$i]['distance']['value'];
                    $place_array[$i]['duration'] = $result [$i]['duration']['value'];
                }
            }
        }else{
            for($i = 0; $i < count($place_array) ; $i ++){
                $place_array[$i]['distance'] = $default_value;
                $place_array[$i]['duration'] = $default_value;
            }
        }

        //foreach ($place_array as &$place){
        //    $place['estimate_fare'] = $place['fare']*($distance_to_destination/1000);
        //}

        return Response::getOutputForAPI($place_array, \Globals::SUCCESS, 'OK',
            ['distance'=>$distance_to_destination, 'duration'=> $duration_to_destination, 'code' => 200]
        );
    }
}

