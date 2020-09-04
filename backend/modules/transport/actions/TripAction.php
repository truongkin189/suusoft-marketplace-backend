<?php
namespace backend\modules\transport\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\AppUserTransactionAPI;
use backend\modules\transport\models\TransportTripAPI;
use common\components\FHtml;
use common\components\Response;
use backend\models\Setting;
use Yii;


class TripAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;


        $trip_id = FHtml::getRequestParam('trip_id', '');
        $action = FHtml::getRequestParam('action', 'finish'); //create/update/delete/cancel/finish/detail
        $passenger_id = FHtml::getRequestParam('passenger_id', '');
        $driver_id = FHtml::getRequestParam('driver_id', '');
        $seat_count = FHtml::getRequestParam('seat_count', '');
        $start_lat = FHtml::getRequestParam('start_lat', '');
        $start_long = FHtml::getRequestParam('start_long', '');
        $start_location = FHtml::getRequestParam('start_location', ''); //beginning address
        $end_lat = FHtml::getRequestParam('end_lat', '');
        $end_long = FHtml::getRequestParam('end_long', '');
        $end_location = FHtml::getRequestParam('end_location', ''); //destination address
        $distance = FHtml::getRequestParam('distance', '');
        $estimate_duration = FHtml::getRequestParam('estimate_duration', '');
        $estimate_distance = FHtml::getRequestParam('estimate_distance', '');
        $estimate_fare = FHtml::getRequestParam('estimate_fare', '');
        $actual_fare = FHtml::getRequestParam('actual_fare', '');
        $payment_method = FHtml::getRequestParam('payment_method', '');  //point/credit/paypal/cod......

        //SHIT BEGINS
        $rate = FHtml::getRequestParam('rate', '');
        $content = FHtml::getRequestParam('content', 'Hohohoh');
        //SHIT_END

        if (strlen($action) == 0) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }

        if (
            strlen($action) != 0
            && $action == \Globals::ACTION_CREATE
            && (
                strlen($passenger_id) == 0
                || strlen($driver_id) == 0
                || strlen($start_lat) == 0
                || strlen($start_long) == 0
                || strlen($end_lat) == 0
                || strlen($end_long) == 0
            )
        ) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }

        if (
            strlen($action) != 0
            && $action != \Globals::ACTION_CREATE
            && strlen($trip_id) == 0
        ) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }

        $now = time();
        $today = date('Y-m-d H:i:s', $now);

        if ($action != \Globals::ACTION_CREATE) {
            $trip = TransportTripAPI::findOne($trip_id);
            if (!isset($trip)) {
                return Response::getOutputForAPI('', \Globals::ERROR, 'Trip not found', ['code' => 261]);
            }
            if (strlen($actual_fare) != 0) {
                $trip->actual_fare = $actual_fare;
            }
        } else {
            $trip = new TransportTripAPI();
            $trip->driver_id = $driver_id;
            $trip->passenger_id = $passenger_id;
            $trip->seat_count = $seat_count;
            $trip->start_lat = $start_lat;
            $trip->start_long = $start_long;
            $trip->start_location = $start_location;
            $trip->end_lat = $end_lat;
            $trip->end_long = $end_long;
            $trip->end_location = $end_location;
            $trip->distance = $distance;
            $trip->estimate_fare = $estimate_fare;
            $trip->estimate_duration = $estimate_duration;
            $trip->estimate_distance = $estimate_distance;
            $trip->is_active = \Globals::STATE_ACTIVE;
            $trip->created_date = $today;
            $trip->time = $now;
            $trip->status = TransportTripAPI::STATUS_PROCESSING;
            $trip->payment_status = 0;
            $trip->actual_fare = 0;
        }
        if ($action == \Globals::ACTION_DETAIL) {
            return Response::getOutputForAPI($trip, \Globals::SUCCESS, 'OK', ['code' => 200]);
        }
        if ($action == \Globals::ACTION_DELETE) {
            if ($user_id == $trip->passenger_id) {
                $trip->passenger_visible = 0;
            } else {
                $trip->driver_visible = 0;
            }
            if ($trip->driver_visible == \Globals::STATE_INACTIVE && $trip->passenger_visible == \Globals::STATE_INACTIVE)
                $trip->is_active = \Globals::STATE_DELETED;
        }

        if ($user_id != $trip->driver_id && $user_id != $trip->passenger_id) {
            return Response::getOutputForAPI('', \Globals::ERROR, Response::getErrorMsg(206), ['code' => 206]);
        }


        if ($action == \Globals::ACTION_DELETE) {
            if ($user_id == $trip->passenger_id) {
                $trip->passenger_visible = 0;
            } else {
                $trip->driver_visible = 0;
            }
            if ($trip->driver_visible == \Globals::STATE_INACTIVE && $trip->passenger_visible == \Globals::STATE_INACTIVE)
                $trip->is_active = \Globals::STATE_DELETED;
        }

        if ($action == \Globals::ACTION_CANCEL) {
            if ($user_id == $trip->passenger_id) {
                $trip->passenger_confirm = 0;
            } else {
                $trip->driver_confirm = 0;
            }
            $trip->status = TransportTripAPI::STATUS_CANCELLED;
        }

        if ($action != \Globals::ACTION_CREATE) {
            $trip->modified_date = $today;
        }

        if ($action == \Globals::ACTION_FINISH) {
            if (strlen($payment_method) != 0) {
                $trip->payment_method = $payment_method;
                $trip->payment_status = \Globals::STATE_ACTIVE;
            }

            if ($trip->status == TransportTripAPI::STATUS_PROCESSING) {
                if ($payment_method == AppUserTransactionAPI::PAYMENT_METHOD_POINT) {
                    if ($trip->passenger->balance < $trip->actual_fare) {
                        return Response::getOutputForAPI('', \Globals::ERROR, 'Your account balance is not enough to do this action', ['code' => 230]);
                    }

                    $passenger_balance = $trip->passenger->balance;
                    $new_balance = $passenger_balance - $trip->actual_fare;
                    $trip->passenger->balance = $new_balance;


                    $key = 'trip-payment-commission';
                    $commission = Yii::$app->cache->get($key);
                    if ($commission == false) {
                        $commission = Setting::getSettingValueByKey(\Globals::TRIP_PAYMENT_FEE);
                        Yii::$app->cache->set($key, $commission, 3600);
                    }

                    $driver_balance = $trip->driver->balance;
                    $fee = $trip->actual_fare - $commission;
                    $new_balance_driver = $driver_balance + $fee;
                    $trip->driver->balance = $new_balance_driver;

                    if ($trip->passenger->save() AND $trip->driver->save()) {
                        $trip->payment_status = \Globals::PAYMENT_STATUS_PAID;
                        $transaction = new AppUserTransactionAPI();
                        $transaction->transaction_id = \Globals::generateTransactionId($user_id);
                        $transaction->user_id = $trip->passenger_id;
                        $transaction->user_visible = 1;
                        $transaction->destination_id = $trip->driver_id;
                        $transaction->object_id = $trip->id;
                        $transaction->object_type = \Globals::OBJECT_TYPE_TRIP;
                        $transaction->amount = $fee;
                        $transaction->currency = 'point';
                        $transaction->payment_method = AppUserTransactionAPI::PAYMENT_METHOD_POINT;
                        $transaction->time = $now;
                        $transaction->action = AppUserTransactionAPI::ACTION_TRIP_PAYMENT;
                        $transaction->type = AppUserTransactionAPI::TYPE_MINUS;
                        $transaction->created_date = $today;
                        $transaction->created_user = $user_id;
                        $transaction->save();
						/*
                        $msg2 = $trip->passenger->name . ' ' . Yii::t('common', 'push.paid') . ' ' . $fee . '$ ' . Yii::t('common', 'push.for.trip');
                        $url2 = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotification',
                            'msg' => $msg2,
                            'user_id' => $trip->driver_id,
                            'type' => 'balance',
                            'additional_data' => $trip->driver->balance,
                        ]);

                        ignore_user_abort(true); // CAUTION!  run over return
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // comment when test
                        curl_setopt($ch, CURLOPT_URL, $url2);
                        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Skip receive return
                        curl_exec($ch);
                        curl_close($ch);
						*/

                    } else {
                        return Response::getOutputForAPI('', \Globals::ERROR, 'Paid fail', ['code' => 207]);
                    }

                } else {
					/*
                    if ($user_id == $trip->passenger_id) {
                        $msg2 = $trip->passenger->name . ' ' . Yii::t('common', 'push.paid') . ' ' . $trip->actual_fare . '$ ' . Yii::t('common', 'push.for.trip');
                        $url2 = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotification',
                            'msg' => $msg2,
                            'user_id' => $trip->driver_id,
                            'type' => 'balance',
                            'additional_data' => $trip->driver->balance,
                        ]);

                        ignore_user_abort(true); // CAUTION!  run over return
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // comment when test
                        curl_setopt($ch, CURLOPT_URL, $url2);
                        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Skip receive return
                        curl_exec($ch);
                        curl_close($ch);
                    }
					*/
                }
            } else {
                return Response::getOutputForAPI('', \Globals::ERROR, Response::getErrorMsg(201), ['code' => 201]);
            }

            if ($user_id == $trip->passenger_id) {
                $trip->passenger_finished = 1;
            } else {
                $trip->driver_finished = 1;

                $additional_data = array(
                    'action' => 'finished'    
                );

                if ($user_id == $trip->driver_id) {
                    $msg2 = $trip->driver->pro->business_name . ' ' . Yii::t('common', 'push.trip.finished');
                    $url2 = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotification',
                        'msg' => $msg2,
                        'user_id' => $trip->passenger_id,
                        'type' => 'trip',
                        'additional_data' => $additional_data,
                    ]);

                    ignore_user_abort(true); // CAUTION!  run over return
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // comment when test
                    curl_setopt($ch, CURLOPT_URL, $url2);
                    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Skip receive return
                    curl_exec($ch);
                        curl_close($ch);
                }

            }
            if ($trip->passenger_finished == 1 && $trip->driver_finished == 1) {
                $trip->status = TransportTripAPI::STATUS_FINISHED;
            }

            //SHIT BEGINS PART 2
            if (strlen($rate) != 0 && strlen($content) != 0) {
                $token = FHtml::getRequestParam('token', '');

                if ($user_id == $trip->passenger_id) {
                    $destination_id = $trip->driver_id;
                    $author_role = 'passenger';
                    $destination_role = 'driver';
                } else {
                    $destination_id = $trip->passenger_id;
                    $author_role = 'driver';
                    $destination_role = 'passenger';
                }

                $url = Yii::$app->urlManager->createAbsoluteUrl(['api/review']);

                $post = [
                    'token' => $token,
                    'destination_id' => $destination_id,
                    'author_role' => $author_role,
                    'destination_role' => $destination_role,
                    'object_id' => $trip_id,
                    'object_type' => \Globals::OBJECT_TYPE_TRIP,
                    'rate' => $rate,
                    'content' => $content,
                ];

                // ignore_user_abort(true);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, count($post));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                curl_setopt($ch, CURLOPT_TIMEOUT, 1); //trick: don't wait for response
                curl_exec($ch);
                curl_close($ch);
            }
            //SHIT END
            if ($trip->save()) {

                $trip->balance = $user_id == $trip->passenger_id ?
                    $trip->passenger->balance
                    :
                    $trip->driver->balance;

                return Response::getOutputForAPI(
                    $trip,
                    \Globals::SUCCESS, 'OK', ['code' => 200]);
            } else {
                $errors = $trip->getErrors();
                $error_message = Response::getErrorMessage($errors);
                return Response::getOutputForAPI('', \Globals::ERROR, $error_message, ['code' => 203]);
            }
        }

        if ($trip->save()) {
            if ($action == \Globals::ACTION_CANCEL) {
                /*
                if($user_id == $trip->passenger_id){
                    $push_name = $trip->passenger->name;
                    $des_id = $trip->driver_id;
                }else{
                    $push_name = $trip->driver->pro->business_name;
                    $des_id = $trip->passenger_id;
                }

                $msg2 = $push_name. ' ' . Yii::t('common', 'push.cancel.trip');
                $url2 = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotification',
                    'msg' => $msg2,
                    'user_id' => $des_id,
                    'type' => 'trip',
                    'additional_data' => '',
                ]);

                ignore_user_abort(true); // CAUTION!  run over return
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // comment when test
                curl_setopt($ch, CURLOPT_URL, $url2);
                curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Skip receive return
                curl_exec($ch);
                curl_close($ch);
                */
            }
            $trip->balance = $user_id == $trip->passenger_id ?
                $trip->passenger->balance
                :
                $trip->driver->balance;
            return Response::getOutputForAPI($trip,
                \Globals::SUCCESS, 'OK', ['code' => 200]);
        } else {
            $errors = $trip->getErrors();
            $error_message = Response::getErrorMessage($errors);
            return Response::getOutputForAPI('', \Globals::ERROR, $error_message, ['code' => 203]);
        }
    }
}

