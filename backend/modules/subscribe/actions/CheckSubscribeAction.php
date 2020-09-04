<?php
namespace backend\modules\subscribe\actions;

use backend\actions\BaseAction;
use backend\modules\subscribe\models\SubscribeAPI;
use common\components\FHtml;
use common\components\Response;

class CheckSubscribeAction extends BaseAction
{
    public function run()
    {
        $subscriber_id = FHtml::getRequestParam('subscriber_id', '');
        $subscribed_id = FHtml::getRequestParam('subscribed_id', '');

        if(strlen($subscriber_id) == 0 || strlen($subscribed_id) == 0)
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $subscribe = SubscribeAPI::findOne(['subscriber_id' => $subscriber_id, 'subscribed_id' => $subscribed_id]);
        
        if(isset($subscribe))
        {
            return Response::getOutputForAPI('', \Globals::SUCCESS, 'Subscribed', ['code'=> 200], '');
        }
        return Response::getOutputForAPI('', \Globals::SUCCESS, 'Not subscribe', ['code'=> 200], '');
    }
}