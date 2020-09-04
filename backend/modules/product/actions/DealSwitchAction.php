<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\product\models\ProductDealAPI;
use common\components\FHtml;
use common\components\Response;

class DealSwitchAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $mode = FHtml::getRequestParam('mode', ''); //on/off
        $deal_id = FHtml::getRequestParam('deal_id', '');

        if (
            strlen($mode) == 0
            || strlen($deal_id) == 0
        ) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }

        $deal = ProductDealAPI::findOne($deal_id);
        if (!isset($deal)) {
            return Response::getOutputForAPI('', \Globals::ERROR, 'Deal not found', ['code'=> 241]);
        }else{
            if($user_id != $deal->seller_id){
                return Response::getOutputForAPI('', \Globals::ERROR, Response::getErrorMsg(206), ['code'=> 206]);
            }
            $now = time();
            $today = date('Y-m-d H:i:s', $now);
            if($mode == 'off'){
                $deal->is_online = \Globals::STATE_INACTIVE;
                $deal->modified_date = $today;
            }
            if($mode == 'on'){


                if(is_numeric($deal->online_started) && is_numeric($deal->online_duration) && ($deal->online_started + 3600 * $deal->online_duration) > $now)
                {
                    $deal->is_online = \Globals::STATE_ACTIVE;
                    $deal->modified_date = $today;

                }else{

                    $deal->online_started = null;
                    $deal->online_duration = null;
                    $deal->reservation_count = 0;
                    $deal->is_online = \Globals::STATE_INACTIVE;
                    $deal->modified_date = $today;

                    $deal->save();
                    return Response::getOutputForAPI('', \Globals::ERROR, Response::getErrorMsg(264), ['code'=> 264]);
                }
            }
            $deal->save();
            return Response::getOutputForAPI('', \Globals::SUCCESS, 'OK', ['code'=> 200]);
        }

    }
}

