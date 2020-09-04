<?php
namespace backend\modules\transport\actions;

use backend\actions\BaseAction;
use backend\models\Setting;
use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserTransactionAPI;
use common\components\FHtml;
use common\components\Response;

class OnlineAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        //clear online_start / online_duration when duration end

        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $mode = FHtml::getRequestParam('mode', ''); //buy/on/off
        $duration = FHtml::getRequestParam('duration', ''); // hours

        if (strlen($mode) == 0) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }

        $check = AppUserAPI::findOne($user_id);

        $balance = $check->balance;
        $online_fee = 0;
        $now = time();
        $today = date('Y-m-d H:i:s', $now);

        if (isset($check->pro)) {
            if(isset($check->driver) || isset($check->vehicle)){
                if($check->driver->is_active == 0){
                    return Response::getOutputForAPI('', \Globals::ERROR, 'Your driver role is not activated', ['code'=> 262]);
                }

                if($mode == 'buy'){

                    if (strlen($duration) == 0) {
                        return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
                    }

                    if (strlen($duration) != 0) {
                        $deal_online_rate = Setting::getSettingValueByKey(\Globals::DRIVER_ONLINE_RATE);
                        $online_fee = $deal_online_rate * $duration;
                        if ($check->balance < $online_fee) {
                            return Response::getOutputForAPI('', \Globals::ERROR, 'Your account balance is not enough to do this action', ['code'=> 230]);
                        }
                        if(isset($check->driver->online_started)&&isset($check->driver->online_duration)){
                            $check->driver->online_duration += $duration;
                        }else{
                            $check->driver->online_started = $now;
                            $check->driver->online_duration = $duration;
                        }
                        $check->driver->is_online = \Globals::STATE_ACTIVE;
                    }
                }else{
                    if($mode == 'on'){
                        if(isset($check->driver->online_started)&&isset($check->driver->online_duration)){
                            $check->driver->is_online = \Globals::STATE_ACTIVE;
                        }else{
                            return Response::getOutputForAPI('', \Globals::ERROR, Response::getErrorMsg(264), ['code'=> 264]);
                        }
                    }
                    if($mode == 'off'){
                        $check->driver->is_online = \Globals::STATE_INACTIVE;
                    }
                }

                if ($check->driver->save()) {

                    if($mode == 'buy') {
                        if (strlen($duration) != 0) {
                            $new_balance = $balance - $online_fee;
                            $check->balance = $new_balance;
                        }
                        if ($check->save()) {
                            if (strlen($duration) != 0) {
                                $transaction = new AppUserTransactionAPI();
                                $transaction->transaction_id = \Globals::generateTransactionId($user_id);
                                $transaction->user_id = $user_id;
                                $transaction->user_visible = 1;
                                $transaction->destination_id = 0;
                                $transaction->currency = 'point';
                                $transaction->object_type = \Globals::OBJECT_TYPE_TRIP;
                                $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                                $transaction->time = $now;
                                $transaction->amount = $online_fee;
                                $transaction->is_active = 1;
                                $transaction->action = AppUserTransactionAPI::ACTION_DRIVER_ONLINE;
                                $transaction->type = AppUserTransactionAPI::TYPE_MINUS;
                                $transaction->created_date = $today;
                                $transaction->created_user = $user_id;
                                $transaction->save();
                            }
                        }else{
                            return Response::getOutputForAPI('', \Globals::ERROR, 'Paid fail', ['code'=> 207]);
                        }
                    }

                    return Response::getOutputForAPI(array('balance'=>$check->balance), \Globals::SUCCESS, 'OK', ['code'=> 200]);
                } else {
                    $errors = $check->driver->getErrors();
                    $error_message = Response::getErrorMessage($errors);
                    return Response::getOutputForAPI('', \Globals::ERROR, $error_message);
                }
            }else{
                return Response::getOutputForAPI('', \Globals::ERROR, 'Please update your driver profile first', ['code'=> 263]);
            }
        } else {
            return Response::getOutputForAPI('', \Globals::ERROR, 'Please update your business profile first', ['code'=> 231]);
        }
    }
}

