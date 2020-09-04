<?php
namespace backend\modules\subscribe\actions;

use backend\actions\BaseAction;
use backend\modules\subscribe\models\SubscribeAPI;
use common\components\FHtml;
use common\components\Response;

class SubscribeAction extends BaseAction
{
    public function run()
    {
        $subscriber_id = FHtml::getRequestParam('subscriber_id', '');
        $subscribed_id = FHtml::getRequestParam('subscribed_id', '');

        if(strlen($subscriber_id) == 0 || strlen($subscribed_id) == 0)
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }
        // comment at 9:29am 24/8
        // $subscribe = new SubscribeAPI();
        // $subscribe->subscriber_id = $subscriber_id;
        // $subscribe->subscribed_id = $subscribed_id;

        // $time_string = time();
        // $subscribe->created_at = date('Y-m-d H:i:s', $time_string);

        // if($subscribe->save())
        // {
        //     return Response::getOutputForAPI($subscribe, \Globals::SUCCESS, 'OK', ['code'=> 200], 1);
        // }
        // return Response::getOutputForAPI('', \Globals::ERROR, 'ERROR', ['code'=> 202], 1);
        // end cmt
        
        // added at 9:30am 24/8
        $subscribe = SubscribeAPI::findOne(['subscriber_id' => $subscriber_id, 'subscribed_id' => $subscribed_id]);
        
        if(isset($subscribe))
        {
            // da dub truoc do => unsub
            if($subscribe->delete())
            {
                // delete success
                return Response::getOutputForAPI('', \Globals::SUCCESS, 'You have successfully unsubscribed', ['code'=> 200], '');
            }
            return Response::getOutputForAPI('', \Globals::ERROR, 'Khong xoa duoc sub', ['code'=> 202]);
        }
        else
        {
            // chua sub thi sub vao
            $subscribe = new SubscribeAPI();
            $subscribe->subscriber_id = $subscriber_id;
            $subscribe->subscribed_id = $subscribed_id;

            $time_string = time();
            $subscribe->created_at = date('Y-m-d H:i:s', $time_string);

            if($subscribe->save())
            {
                return Response::getOutputForAPI($subscribe, \Globals::SUCCESS, 'You have just subscribed successfully', ['code'=> 200], '');
            }
            return Response::getOutputForAPI('', \Globals::ERROR, 'ERROR', ['code'=> 202], '');
        }

        // end add
        
    }
}