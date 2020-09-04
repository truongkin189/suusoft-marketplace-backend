<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\AppUserFavouriteAPI;
use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserAPI_few;
use backend\modules\product\models\ProductDealAPI;
use common\components\FHtml;
use common\components\Response;
use Yii;
use \stdClass;

class ListProductSellerIdAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        // GET PRODUCTS THEO SELLER_ID VÀ THÔNG TIN SELLER ĐÓ
        // chua phan trang

        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $seller_id = FHtml::getRequestParam('seller_id', '');
        $inventory = FHtml::getRequestParam('inventory', 1); //0-not care quantity/ 1- care
        
        $page = FHtml::getRequestParam('page', 1);
        $number_per_page = FHtml::getRequestParam('number_per_page', 10);


        if (strlen($seller_id) == 0 || strlen($inventory) == 0) {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        // nhieu
        // $products = AppUserAPI::findOne($seller_id);

        $result = array();

        $recordPerPage = $number_per_page;

        $seller_info = AppUserAPI_few::findOne($seller_id);

        if($inventory == 1)
        {
            if($user_id == $seller_id)
            {
                $total = ProductDealAPI::find()
                ->innerJoin('app_user', 'product_deal.seller_id = app_user.id')
                ->where(['app_user.id' => $user_id])
                ->andWhere(['>','product_deal.quantity','0'])
                // ->andWhere(['product_deal.is_active' => 1])
                ->count();
    
                $total_page = ceil($total / $recordPerPage);
                $start_index = $page * $recordPerPage - $recordPerPage;
    
                $list_products = ProductDealAPI::find()
                ->innerJoin('app_user', 'product_deal.seller_id = app_user.id')
                ->where(['app_user.id' => $user_id])
                ->andWhere(['>','product_deal.quantity','0'])
                // ->andWhere(['product_deal.is_active' => 1])
              
                ->limit($recordPerPage)
                ->offset($start_index)
                // ->asArray()
                ->all();
            }
            else
            {
                $total = ProductDealAPI::find()
                ->innerJoin('app_user', 'product_deal.seller_id = app_user.id')
                ->where(['app_user.id' => $seller_id])
                ->andWhere(['>','product_deal.quantity','0'])
                ->andWhere(['product_deal.is_active' => 1])
       
                ->count();
    
                $total_page = ceil($total / $recordPerPage);
                $start_index = $page * $recordPerPage - $recordPerPage;
    
                $list_products = ProductDealAPI::find()
                ->innerJoin('app_user', 'product_deal.seller_id = app_user.id')
                ->where(['app_user.id' => $seller_id])
                ->andWhere(['>','product_deal.quantity','0'])
                ->andWhere(['product_deal.is_active' => 1])
              
                ->limit($recordPerPage)
                ->offset($start_index)
                // ->asArray()
                ->all();
            }
        }
        else
        {
            //dont care about product's quantity is seller
            // sai
            
            
            $total = ProductDealAPI::find()
            ->innerJoin('app_user', 'product_deal.seller_id = app_user.id')
            // ->where(['app_user.id' => $user_id])
            ->where(['product_deal.seller_id' => $seller_id])
            ->count();

            $total_page = ceil($total / $recordPerPage);
            $start_index = $page * $recordPerPage - $recordPerPage;

            $list_products = ProductDealAPI::find()
            ->innerJoin('app_user', 'product_deal.seller_id = app_user.id')
            // ->where(['app_user.id' => $user_id])
            ->where(['product_deal.seller_id' => $seller_id])
            ->limit($recordPerPage)
            ->offset($start_index)
            // ->asArray()
            ->all();
        }

        foreach($list_products as $key=>$el)
        {
            // $el is an array
            $el['image'] = Yii::$app->urlManager
                ->createAbsoluteUrl(['api/file', 'f'=> $el['image'], 'd' => PRODUCT_DEAL_DIR]);

            $list_products[$key]['image'] = $el['image'];
 
        }

        $result = ['seller_info' => $seller_info, 'list_products' => $list_products];


        return Response::getOutputForAPI($result, \Globals::SUCCESS, 'OK', ['code'=> 200], $total_page*1);

    }
}