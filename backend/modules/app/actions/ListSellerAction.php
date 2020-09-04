<?php
namespace backend\modules\app\actions;

use backend\actions\BaseAction;
use common\components\FHtml;
use common\components\Response;
use backend\modules\app\models\AppUserAPI;
use backend\modules\product\models\ProductDeal;

class ListSellerAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        // if (($re = $this->isAuthorized()) !== true)
        //     return $re;

        // $user_id = $this->user_id;

        $seller_name = isset($_REQUEST['seller_name']) ? $_REQUEST['seller_name'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $number_per_page = isset($_REQUEST['number_per_page']) ? $_REQUEST['number_per_page'] : 20;

        if($seller_name == '')
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }
        else
        {
            $recordPerPage = $number_per_page;

            $id_seller = ProductDeal::find()
            ->select(['product_deal.seller_id'])
            ->groupBy('product_deal.seller_id')
            ->all();

            $arr_id = array();

            foreach($id_seller as $id)
            {
                $arr_id[] = $id->seller_id;
            }

            $total = AppUserAPI::find()
            ->where(['LIKE', 'name', $seller_name])
            ->orWhere(['LIKE', 'username', $seller_name])
            ->andWhere(['IN','id',$arr_id])
            ->count();

            $total_page = ceil($total / $recordPerPage);
            $start_index = $page * $recordPerPage - $recordPerPage;

            // name or username
            $sellers = AppUserAPI::find()
            ->where(['LIKE', 'name', $seller_name])
            ->orWhere(['LIKE', 'username', $seller_name])
            ->andWhere(['IN','id',$arr_id])
            // ->limit(10)
            ->limit($recordPerPage)
            ->offset($start_index)
            ->all();
        
            return Response::getOutputForAPI($sellers, \Globals::SUCCESS, 'OK', ['code' => 200]);
        }

    
        

        
    }
}