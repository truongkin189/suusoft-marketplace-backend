<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\models\Setting;
use backend\modules\product\models\ProductDealAPI;
use backend\modules\object\models\ObjectCategoryAPI;
use common\components\FHtml;
use common\components\Response;
use \stdClass;
use Yii;

class ListProductRadiusAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        // if (($re = $this->isAuthorized()) !== true)
        //     return $re;
        // $user_id = $this->user_id;

        //range in meter, SEARCHING_PRODUCT_DISTANCE in km
        $products_search_range = Setting::getSettingValueByKey(\Globals::SEARCHING_PRODUCT_DISTANCE)*1000;
        $buyer_lat = FHtml::getRequestParam('buyer_lat', '');
        $buyer_long = FHtml::getRequestParam('buyer_long', '');
        $buyer_id = FHtml::getRequestParam('buyer_id', '');

        // phan trang pagination
        $page = FHtml::getRequestParam('page', 1);
        $number_per_page = FHtml::getRequestParam('number_per_page', \Globals::DEFAULT_ITEMS_PER_PAGE);
        
        $is_active = 1;

        if (strlen($buyer_lat) == 0 || strlen($buyer_long) == 0) {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        // $driver_search_range = Setting::getSettingValueByKey(\Globals::SEARCHING_DRIVER_DISTANCE);

        $condition = "place.distance <= " . $products_search_range . " AND place.id <> " . $buyer_id . " AND product_deal.is_active = " . $is_active;


        $recordPerPage = $number_per_page;

        $total = (new \yii\db\Query())
        ->select(['place.id',
            'place.qb_id',
            // 'app_user_pro.business_name AS name',
            'place.email',
            'place.lat',
            'place.long',
            'product_deal.name',
            'product_deal.description',
            'product_deal.price',
            'product_deal.sale_price',
            'app_user_pro.rate',
            'app_user_pro.rate_count',
            'transport_driver.type',
            'transport_driver.fare',
            'transport_driver.is_sos',
            'transport_driver.is_delivery',
            'app_user_pro.business_phone',
            'app_user_pro.business_email'
        ])
        ->from("
        (SELECT *, (((acos(sin((" . $buyer_lat . "*pi()/180)) *
                sin((`lat`*pi()/180))+cos((" . $buyer_lat . "*pi()/180)) *
                cos((`lat`*pi()/180)) * cos(((" . $buyer_long . " -
                        `long`)*pi()/180))))*180/pi())*60*1.1515*1.609344)
        as distance
        FROM `app_user`) place")
        ->where($condition)
        // ->andWhere(['place.id' ])
        ->innerJoin('product_deal', 'place.id = product_deal.seller_id')
        ->innerJoin('object_category', 'product_deal.category_id = object_category.id')
        // ->join('INNER JOIN', 'app_user_pro', 'place.id = app_user_pro.user_id')
        // ->join('INNER JOIN', 'transport_driver', 'place.id = transport_driver.user_id')
        // ->groupBy('place.id')
        // ->orderBy('place.id ASC')
        ->count();

        $total_page = ceil($total / $recordPerPage);
        $start_index = $page * $recordPerPage - $recordPerPage;

        $products = (new \yii\db\Query())
            ->select(['place.id',
                'place.qb_id',
                // 'app_user_pro.business_name AS name',
                'place.email',
                'place.lat',
                'place.long',
                'product_deal.name',
                'product_deal.description',
                'product_deal.price',
                'product_deal.sale_price',
                'app_user_pro.rate',
                'app_user_pro.rate_count',
                'transport_driver.type',
                'transport_driver.fare',
                'transport_driver.is_sos',
                'transport_driver.is_delivery',
                'app_user_pro.business_phone',
                'app_user_pro.business_email'
            ])
            ->from("
            (SELECT *, (((acos(sin((" . $buyer_lat . "*pi()/180)) *
                    sin((`lat`*pi()/180))+cos((" . $buyer_lat . "*pi()/180)) *
                    cos((`lat`*pi()/180)) * cos(((" . $buyer_long . " -
                            `long`)*pi()/180))))*180/pi())*60*1.1515*1.609344)
            as distance
            FROM `app_user`) place")
            ->where($condition)
            // ->andWhere(['place.id' ])
            ->innerJoin('product_deal', 'place.id = product_deal.seller_id')
            ->innerJoin('object_category', 'product_deal.category_id = object_category.id')
            // ->join('INNER JOIN', 'app_user_pro', 'place.id = app_user_pro.user_id')
            // ->join('INNER JOIN', 'transport_driver', 'place.id = transport_driver.user_id')
            // ->groupBy('place.id')
            ->orderBy('place.id ASC')
            ->limit($recordPerPage)
            ->offset($start_index)
            ->all();

            foreach($products as $key=>$el)
            {
                $el['image'] = Yii::$app->urlManager
                    ->createAbsoluteUrl(['api/file', 'f'=> $el['image'], 'd' => PRODUCT_DEAL_DIR]);
                    
                $el['attachment'] = Yii::$app->urlManager
                    ->createAbsoluteUrl(['api/file', 'f'=> $el['attachment'], 'd' => PRODUCT_DEAL_DIR]);

                $products[$key]['image'] = $el['image'];
                $products[$key]['attachment'] = $el['attachment'];
            }


        return Response::getOutputForAPI($products, \Globals::SUCCESS, 'OK', ['code'=> 200], $total_page*1);

    }
}