<?php
namespace backend\actions;

use backend\models\Setting;
use common\components\Response;
use Yii;
use yii\helpers\Url;


class ShowAppSettingAction extends BaseAction
{
    public function run()
    {
        $deal_online_rate = Setting::getSettingValueByKey(\Globals::DEAL_ONLINE_RATE);
        $premium_deal_online_rate = Setting::getSettingValueByKey(\Globals::PREMIUM_DEAL_ONLINE_RATE);
        $driver_online_rate = Setting::getSettingValueByKey(\Globals::DRIVER_ONLINE_RATE);
        $exchange_rate = Setting::getSettingValueByKey(\Globals::EXCHANGE_RATE);
        $search_deal = Setting::getSettingValueByKey(\Globals::SEARCHING_DEAL_DISTANCE);
        $search_driver = Setting::getSettingValueByKey(\Globals::SEARCHING_DRIVER_DISTANCE);
        $transfer_fee = Setting::getSettingValueByKey(\Globals::TRANSFER_FEE);
        $exchange_fee = Setting::getSettingValueByKey(\Globals::EXCHANGE_FEE);
        $redeem_fee = Setting::getSettingValueByKey(\Globals::REDEEM_FEE);
        $deal_payment_fee = Setting::getSettingValueByKey(\Globals::DEAL_PAYMENT_FEE);
        $trip_payment_fee = Setting::getSettingValueByKey(\Globals::TRIP_PAYMENT_FEE);

        //$faq = Url::base( true).'/'. Url::to('setting/faq');
        //$about = Url::base( true).'/'. Url::to('setting/about');
        //$help = Url::base( true).'/'. Url::to('setting/help');
        $faq = Yii::$app->urlManager->createAbsoluteUrl(['setting/faq']);
        $about = Yii::$app->urlManager->createAbsoluteUrl(['setting/about']);
        $help = Yii::$app->urlManager->createAbsoluteUrl(['setting/help']);
        $term = Yii::$app->urlManager->createAbsoluteUrl(['setting/term']);

        $data = array(
            'deal_online_rate' => $deal_online_rate,
            'premium_deal_online_rate' => $premium_deal_online_rate,
            'driver_online_rate' => $driver_online_rate,
            'exchange_rate' => $exchange_rate,
            'exchange_fee' => $exchange_fee,
            'redeem_fee' => $redeem_fee,
            'transfer_fee' => $transfer_fee,
            'searching_deal_distance' => $search_deal,
            'searching_driver_distance' => $search_driver,
            'deal_payment_fee' => $deal_payment_fee,
            'trip_payment_fee' => $trip_payment_fee,
            'faq'=> $faq,
            'about'=> $about,
            'help'=> $help,
            'term'=> $term
        );
        return Response::getOutputForAPI($data, \Globals::SUCCESS, 'OK', ['code'=> 200]);
    }
}
