<?php

namespace backend\modules\app\models;

use backend\modules\category\models\CategoryAPI;
use backend\modules\categorysub\models\CategorySubAPI;
use backend\modules\goods\models\GoodsAPI;
use Yii;

class AppUserAPI_few extends AppUserBase
{
    public $listGoods = array();
    public $page_in_api;

    public function fields()
    {
        $fields = [
                    'id',
                    'qb_id',
                    'avatar',
                    'name',
                    'username',
                    'email',
                    'description',
                    'balance',
                    'gender',
                    'phone',
                    'dob',
                    'address',
                    'lat',
                    'long',
                    'is_active',
                    'status',
                    'rate',
                    'rate_count',
                    'created_date',
                    'modified_date'
        ];
        
        // added 9:31am 15/8/19
        if(!isset($this->avatar) || strlen($this->avatar) == 0){
            $avatar_link = "";
        }else{
            $avatar_link = Yii::$app->urlManager
                ->createAbsoluteUrl(['api/file', 'f'=> $this->avatar, 'd' => APP_USER_DIR]);
        }
        $this->avatar = $avatar_link;
        // end

        // $this->listGoods = $this->productsBySellerId;

        // return array_merge($fields, ['listGoods']);
        return $fields;
    }


}