<?php
namespace backend\modules\transport\actions;

use backend\actions\BaseAction;
use backend\modules\transport\models\TransportTripAPI;
use backend\modules\transport\models\TransportTripBase;
use common\components\FHtml;
use common\components\Response;

class TrackDriverAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized())!== true)
            return $re;

        $trip_id = FHtml::getRequestParam('trip_id', '');

        $check = TransportTripAPI::findOne($trip_id);

        if (isset($check)) {
            if($check->status == TransportTripBase::STATUS_PROCESSING){
                $data= array(
                    'id' =>'',
                    'lat'=> '',
                    'long' => ''
                );
                if(isset($check->driver)){
                    $data= array(
                        'id' =>$check->driver_id,
                        'lat'=>$check->driver->lat,
                        'long' =>$check->driver->long
                    );
                }
                return Response::getOutputForAPI($data, \Globals::SUCCESS, 'OK', ['code'=> 200]);
            }else{
                return Response::getOutputForAPI('', \Globals::ERROR, Response::getErrorMsg(206), ['code'=> 206]);
            }

        } else {
            return Response::getOutputForAPI('', \Globals::ERROR, 'Trip not found', ['code'=> 261]);
        }
    }
}
