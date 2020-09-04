<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\AppUserFavouriteAPI;
use backend\modules\product\models\ProductDealAPI;
use common\components\FHtml;
use common\components\Response;

class DealDetailAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $deal_id = FHtml::getRequestParam('deal_id', '');

        if (strlen($deal_id) == 0) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }


        $deal = ProductDealAPI::findOne($deal_id);
        if (!isset($deal)) {
            return Response::getOutputForAPI('', \Globals::ERROR, 'Deal not found', ['code'=> 241]);
        }

        $favourites = AppUserFavouriteAPI::find()->where("user_id = $user_id AND object_type = 'deal'")->all();
        $favourite_ids = array();
        foreach ($favourites as $favourite){
            $favourite_ids[] = $favourite->object_id;
        }
        $deal->is_favourite = in_array($deal->id, $favourite_ids) ? 1 : 0;

        return Response::getOutputForAPI($deal, \Globals::SUCCESS, 'OK', ['code'=> 200]);

    }
}

