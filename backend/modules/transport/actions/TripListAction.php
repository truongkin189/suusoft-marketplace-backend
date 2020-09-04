<?php
namespace backend\modules\transport\actions;

use backend\actions\BaseAction;
use backend\modules\transport\models\TransportTripAPI;
use common\components\FHtml;
use common\components\Response;

class TripListAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $page = FHtml::getRequestParam('page', 1);
        $number_per_page = FHtml::getRequestParam('number_per_page', \Globals::DEFAULT_ITEMS_PER_PAGE);
        $search_type = FHtml::getRequestParam('search_type', ''); //processing/history

        $condition = "is_active = ".\Globals::STATE_ACTIVE;

        if(strlen($search_type)!=0){
            if($search_type == 'processing'){
                $condition .= " AND status = '".TransportTripAPI::STATUS_PROCESSING."' 
                AND ((driver_id = $user_id AND driver_visible = 1 AND driver_finished = 0) OR (passenger_id = $user_id  AND passenger_visible = 1 AND passenger_finished = 0))";
            }
            if($search_type == 'history'){
                $condition .= " AND ((driver_id = $user_id AND driver_visible = 1 AND (status != '".TransportTripAPI::STATUS_PROCESSING."' OR  driver_finished = 1))
                OR (passenger_id = $user_id AND passenger_visible = 1 AND (status != '".TransportTripAPI::STATUS_PROCESSING."' OR  passenger_finished = 1)))";
            }
        }

        $order = 'time DESC';

        $recordPerPage = $number_per_page;

        $total = TransportTripAPI::find()->where($condition)->count();

        $total_page = ceil($total / $recordPerPage);
        $start_index = $page * $recordPerPage - $recordPerPage;

        $deals = TransportTripAPI::find()->where($condition)->limit($recordPerPage)->offset($start_index)->orderBy($order)->all();

        $data = array();

        foreach ($deals as $deal){
            $data[] = $deal;
        }

        return Response::getOutputForAPI($deals, \Globals::SUCCESS, 'OK', ['total_page' => $total_page, 'code'=> 202]);

    }
}

