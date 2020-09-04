<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\AppUserFavouriteAPI;
use backend\modules\product\models\ProductDealAPI;
use common\components\FHtml;
use common\components\Response;
use yii\db\Expression;

class DealListAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;
        $user_id = $this->user_id;

        $keyword = FHtml::getRequestParam('keyword', '');
        $search_type = FHtml::getRequestParam('search_type', 'all'); //mine/nearby/all/favourite/review
        $is_online = FHtml::getRequestParam('is_online', ''); //1: online / 0: offline /  empty -> all
        $distance = FHtml::getRequestParam('distance', 50); //km
        $lat = FHtml::getRequestParam('lat', '');
        $long = FHtml::getRequestParam('long', '');
        $category_id = FHtml::getRequestParam('category_id', '');
        $page = FHtml::getRequestParam('page', 1);
        $number_per_page = FHtml::getRequestParam('number_per_page', \Globals::DEFAULT_ITEMS_PER_PAGE);
        $sort_type = FHtml::getRequestParam('sort_type', ''); //DESC/ASC
        $sort_by = FHtml::getRequestParam('sort_by', ''); //distance/rate/name/sale_price

        if (
            strlen($search_type) == 0
            || ($search_type == \Globals::SEARCH_TYPE_NEARBY && (strlen($distance) == 0 || strlen($lat) == 0 || strlen($long) == 0))
        ) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }


        $base_condition = 'is_active != ' . \Globals::STATE_INACTIVE;

        if (strlen($category_id) != 0) {
            $base_condition .= " AND category_id = $category_id";
        }

        if (strlen($is_online) != 0 ) {
            $base_condition .= ' AND is_online = ' . $is_online;
        }
        $condition = $base_condition;

        if (strlen($keyword) != 0) {
            $condition .= " AND name LIKE '%$keyword%'";
            //$condition .= " AND name LIKE '%$keyword%' OR description LIKE '%$keyword%' OR address LIKE '%$keyword%'";
        }

        if (strlen($category_id) != 0) {
            $condition .= " AND category_id = $category_id";
        }

        $order = 'modified_date DESC';//default sort

        if (strlen($sort_type) != 0 AND strlen($sort_by) != 0) {
            if ($sort_by != 'distance') { //distance not working if not search by nearby
                $order = $sort_by . ' ' . $sort_type;
            }
        }

        if ($search_type == \Globals::SEARCH_TYPE_FAVOURITE) {
            $condition .= " AND id IN (SELECT object_id FROM app_user_favourite WHERE user_id = $user_id AND object_type = 'deal')";
        }else if ($search_type == \Globals::SEARCH_TYPE_REVIEW) {
            $condition .= " AND id IN (SELECT object_id FROM app_user_review WHERE ( author_id = $user_id OR destination_id = $user_id ) AND object_type = 'deal')";
        }
        else if ($search_type == \Globals::SEARCH_TYPE_NEARBY) {

            if($sort_by == 'distance'){
                $order_inside = $sort_by . ' ' . $sort_type;
            }else{
                $order_inside = $order;
            }

            $child_condition = $base_condition . " AND distance <= " . $distance;

            $place_array = array();
            $rows = (new \yii\db\Query())
                ->select(['place.*'])
                ->from("
            (SELECT *, (((acos(sin((" . $lat . "*pi()/180)) *
                    sin((`lat`*pi()/180))+cos((" . $lat . "*pi()/180)) *
                    cos((`lat`*pi()/180)) * cos(((" . $long . "-
                            `long`)*pi()/180))))*180/pi())*60*1.1515*1.609344)
            as distance
            FROM `product_deal`) place")
                ->where($child_condition)
                ->orderBy($order_inside)
                ->all();
            foreach ($rows as $place) {
                $place_array[] = $place['id'];
            }

            $deal_id_string = 0;
            if (count($place_array) != 0) {
                $deal_id_string = implode(',', $place_array);
                //http://stackoverflow.com/questions/1631723/maintaining-order-in-mysql-in-query
                //ORDER BY FIELD(f.id, 2, 3, 1);
                //IN con condition keep order of Ids
                $order = new Expression("FIELD (id, $deal_id_string)");
            }
            $condition .= ' AND id IN (' . $deal_id_string . ')';

        }elseif ($search_type == \Globals::SEARCH_TYPE_MINE) {
            $condition .= " AND seller_id = $user_id";
        }else{

        }

        $recordPerPage = $number_per_page;

        $total = ProductDealAPI::find()->where($condition)->count();

        $total_page = ceil($total / $recordPerPage);
        $start_index = $page * $recordPerPage - $recordPerPage;
        // phan trang

        $deals = ProductDealAPI::find()->where($condition)->limit($recordPerPage)->offset($start_index)->orderBy($order)->all();

        $data = array();

        $favourites = AppUserFavouriteAPI::find()->where("user_id = $user_id AND object_type = 'deal'")->all();
        $favourite_ids = array();
        foreach ($favourites as $favourite) {
            $favourite_ids[] = $favourite->object_id;
        }
        foreach ($deals as $deal) {
            $deal->is_favourite = in_array($deal->id, $favourite_ids) ? 1 : 0;
            $data[] = $deal;
        }
        return Response::getOutputForAPI($data, \Globals::SUCCESS, 'OK', ['total_page' => $total_page, 'code' => 200]);
    }
}