<?php
namespace backend\modules\transport\actions;

use backend\actions\BaseAction;
use backend\modules\transport\models\TransportTripAPI;
use common\components\Response;


class TripBulkDeleteAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;

        $user_id = $this->user_id;
        TransportTripAPI::updateAll(['passenger_visible' => 0], ['passenger_id' => $user_id]);
        TransportTripAPI::deleteAll(['passenger_id' => $user_id, 'driver_visible' => 0, 'passenger_visible' => 0]);
        TransportTripAPI::updateAll(['driver_visible' => 0], ['driver_id' => $user_id]);
        TransportTripAPI::deleteAll(['driver_id' => $user_id, 'driver_visible' => 0, 'passenger_visible' => 0]);
        return Response::getOutputForAPI('', \Globals::SUCCESS, 'OK', ['code' => 200]);
    }
}

