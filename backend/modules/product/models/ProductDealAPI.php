<?php

namespace backend\modules\product\models;

use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserProAPI;
use backend\modules\app\models\AppUserReviewAPI;
use backend\modules\product\models\ProductDealImageAPI;
use Yii;

/**
 * @property  AppUserProAPI $pro
 * @property  AppUserAPI $user
 * @property  AppUserReviewAPI[] $reviews
 */

class ProductDealAPI extends ProductDealBase
{
    public $pro_data;
    public $seller_avatar;
    public $seller_qb_id;
    public $is_favourite;
    public $balance;
    public $product_images = array();

    public function fields()
    {
        $fields = [
            'id',
            // 'image',
            'name',
            'attachment',
            'description',
            'content',
            'category_id',
            'quantity',
            'price',
            'sale_price',
            'discount',
            'discount_rate',
			'discount_type',
            'discount_expired',
            'is_online',
            'online_started',
            'online_duration',
            'is_premium',
            'is_renew',
            'lat',
            'long',
            'status',
            'is_active',
            'country',
            'state',
            'city',
            'address',
            'seller_id',
            'view_count',
            'like_count',
            'is_favourite',
            'reservation_count',
            'rate',
            'rate_count',
            'created_date',
            'modified_date',
            'created_user',
            'modified_user',
            'balance'
        ];
        
        // $this->quantity *= 1;
        // $this->price *= 1.0;
        // $this->sale_price *= 1.0;
        // $this->discount *= 1;
        // $this->discount_rate *= 1.0;
        // $this->rate_count *= 1;
        // $this->rate *= 1.0;
        
        // $this->is_premium *= 1;
        // $this->is_renew *= 1;
    
        foreach($this->productImage as $el)
        {
            $el->image = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $el->image, 'd' => PRODUCT_DEAL_DIR]);
        }

        $this->product_images = $this->productImage;

        $this->is_favourite = 0;

        $image_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->image, 'd' => PRODUCT_DEAL_DIR, 's'=>'thumb']);
        $attachment_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->attachment, 'd' => PRODUCT_DEAL_DIR]);

        $avatar_link = null;
        $qb_id = null;

        if(isset($this->user)){
            if (filter_var($this->user->avatar, FILTER_VALIDATE_URL)) {
                $avatar_link =  $this->user->avatar;
            }else{
                $avatar_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->user->avatar, 'd' => APP_USER_DIR, 's'=>'thumb']);
            }
            $qb_id = $this->user->qb_id;
        }
        // $this->image = $image_link;
        $this->attachment = $attachment_link;

        $this->seller_avatar = $avatar_link;
        $this->seller_qb_id = $qb_id;
        $this->pro_data = $this->pro;

        $fields = array_merge($fields, ['seller_avatar', 'seller_qb_id', 'pro_data','product_images']);
        return $fields;
    }

    public function rules()
    {
        return [];
    }

    public function getPro()
    {
        return $this->hasOne(AppUserProAPI::className(), ['user_id' => 'seller_id']);
    }

    public function getUser()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'seller_id']);
    }

  
    public function getProductImage()
    {
        return $this->hasMany(ProductDealImageAPI::className(), ['product_deal_id' => 'id']);
    }
/*
    public function getReviews()
    {
        return $this->hasMany(AppUserReviewAPI::className(), ['object_id' => 'id'])
            ->andOnCondition(['object_type' => \Globals::OBJECT_TYPE_DEAL]);
    }
*/	
	 public function getReviews()
    {
        return $this->hasMany(AppUserReviewAPI::className(), ['object_id' => 'id'])
            ->andOnCondition(['and',
                ['object_type' => \Globals::OBJECT_TYPE_DEAL],
                ['or',
                    ['destination_role' => \Globals::ROLE_SELLER],
                    ['destination_role' => \Globals::ROLE_DRIVER],
                ]
            ]);
    }

}
