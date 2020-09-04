<?php
namespace backend\modules\app\actions;

use backend\actions\BaseAction;
use common\components\FHtml;
use common\components\Response;
use backend\modules\app\models\AppUserAPI;
use backend\modules\product\models\ProductDeal;

use Yii;

class ListSellerRadiusAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        // if (($re = $this->isAuthorized()) !== true)
        //     return $re;

        // $user_id = $this->user_id;

        $distance = isset($_REQUEST['distance']) ? $_REQUEST['distance'] : '';
        $lat = isset($_REQUEST['lat']) ? $_REQUEST['lat'] : '';
        $long = isset($_REQUEST['long']) ? $_REQUEST['long'] : '';

        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
        $number_per_page = isset($_REQUEST['number_per_page']) ? $_REQUEST['number_per_page'] : '';
        $seller_name = isset($_REQUEST['seller_name']) ? $_REQUEST['seller_name'] : '';

        if(strlen($distance) == 0 || strlen($lat) == 0 || strlen($long) == 0)
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }
        else
        {
            $recordPerPage = $number_per_page;

            // get id of user is seller put into $arr_id
            // hoi thua khi join voi product_deal vi seller_id = id user trong app_user
            $id_seller = ProductDeal::find()
            ->select(['product_deal.seller_id'])
            ->groupBy('product_deal.seller_id')
            ->all();

            $arr_id = array();

            foreach($id_seller as $id)
            {
                $arr_id[] = $id->seller_id;
            }
            // end

            $condition = " place.distance <= " . $distance;

            $total = (new \yii\db\Query())
            ->select(['place.id',
                'place.avatar',
                'place.email',
                'place.phone',
                'place.address',
                'place.country',
                'place.state',
                'place.city',
                'place.lat',
                'place.long',
                'app_user_pro.business_name',
                'app_user_pro.business_email',
                'app_user_pro.business_phone',
                'app_user_pro.business_address',
                'app_user_pro.business_website'

            ])
            ->from("
            (SELECT *, (((acos(sin((" . $lat . "*pi()/180)) *
                    sin((`lat`*pi()/180))+cos((" . $lat . "*pi()/180)) *
                    cos((`lat`*pi()/180)) * cos(((" . $long . " -
                            `long`)*pi()/180))))*180/pi())*60*1.1515*1.609344)
            as distance
            FROM `app_user`) place")
            ->innerJoin('product_deal', 'place.id = product_deal.seller_id')
            ->innerJoin('app_user_pro', 'app_user_pro.user_id = place.id')
            ->where($condition)
            ->andWhere(['LIKE', 'app_user_pro.business_name', $seller_name])
            ->count();


            $total_page = ceil($total / $recordPerPage);
            $start_index = $page * $recordPerPage - $recordPerPage;

            $sellers = (new \yii\db\Query())
            ->select(['place.id',
                'place.avatar',
                'place.name',
                'place.email',
                'place.phone',
                'place.address',
                'place.country',
                'place.state',
                'place.city',
                'place.lat',
                'place.long',
                'app_user_pro.business_name',
                'app_user_pro.business_email',
                'app_user_pro.business_phone',
                'app_user_pro.business_address',
                'app_user_pro.business_website'

            ])
            ->from("
            (SELECT *, (((acos(sin((" . $lat . "*pi()/180)) *
                    sin((`lat`*pi()/180))+cos((" . $lat . "*pi()/180)) *
                    cos((`lat`*pi()/180)) * cos(((" . $long . " -
                            `long`)*pi()/180))))*180/pi())*60*1.1515*1.609344)
            as distance
            FROM `app_user`) place")
            ->innerJoin('product_deal', 'place.id = product_deal.seller_id')
            ->innerJoin('app_user_pro', 'app_user_pro.user_id = place.id')
            ->where($condition)
            ->andWhere(['LIKE', 'app_user_pro.business_name', $seller_name])
            ->orderBy('place.id ASC')
            ->groupBy('place.id')
            ->limit($recordPerPage)
            ->offset($start_index)
            ->all();

            foreach($sellers as $key=>$seller)
            {
                $seller['avatar'] = Yii::$app->urlManager
                    ->createAbsoluteUrl(['api/file', 'f'=> $seller['avatar'], 'd' => APP_USER_DIR]);
                
                $sellers[$key]['avatar'] = $seller['avatar'];
            }

            return Response::getOutputForAPI($sellers, \Globals::SUCCESS, 'OK', ['code' => 200],$total_page);
        }
    }
}