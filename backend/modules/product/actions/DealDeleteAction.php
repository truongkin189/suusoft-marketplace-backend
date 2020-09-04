<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\AppUserFavouriteAPI;
use backend\modules\product\models\ProductDealAPI;
use backend\modules\product\models\ProductDealImageAPI;
use common\components\FHtml;
use common\components\Response;
use \stdClass;

class DealDeleteAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $deal_id = FHtml::getRequestParam('deal_id', '');

        if (strlen($deal_id) == 0) {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }


        $deal = ProductDealAPI::findOne($deal_id);
        if (isset($deal) && $deal->seller_id == $user_id) {
        // if(true){
            if($deal->delete())
            {
                ProductDealImageAPI::deleteAll(['product_deal_id' => $deal_id]);
                return Response::getOutputForAPI(new stdClass(), \Globals::SUCCESS, 'Delete product successfully!', ['code'=> 200]);
            }
            
        }
        else
        {
            return Response::getOutputForAPI(new stdClass(), \Globals::SUCCESS, 'Product not found or you cannot do this action', ['code'=> 241]);
        }
        
    }
}
