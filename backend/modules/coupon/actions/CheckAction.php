<?php
namespace backend\modules\coupon\actions;

use backend\actions\BaseAction;
use backend\modules\coupon\models\CouponAPI;
use common\components\FHtml;
use common\components\Response;

class CheckAction extends BaseAction
{
    public function run()
    {
        $code = FHtml::getRequestParam('code', '');

        if(strlen($code) == 0)
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $result = CouponAPI::findOne(['code' => $code]);

        return Response::getOutputForAPI($result, \Globals::SUCCESS, 'OK', ['code'=> 200], 1);
    }
}