<?php

namespace backend\modules\product\models;

/**
 * @property string $id
 * @property string $image
 * @property string $attachment
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $category_id
 * @property string $quantity
 * @property double $price
 * @property double $sale_price
 * @property double $discount
 * @property integer $discount_rate
 * @property string $discount_type 
 * @property string $discount_expired
 * @property integer $is_online
 * @property string $online_started
 * @property integer $online_duration
 * @property integer $is_premium
 * @property integer $is_renew
 * @property string $status
 * @property integer $is_active
 * @property string $lat
 * @property string $long
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $address
 * @property integer $seller_id
 * @property integer $view_count
 * @property integer $like_count
 * @property double $rate
 * @property integer $rate_count
 * @property integer $reservation_count
 * @property string $created_date
 * @property string $created_user
 * @property string $modified_date
 * @property string $modified_user
 * @property string $application_id
 */
class ProductDealBase extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 'PENDING';
    const STATUS_NEW = 'NEW';
    const STATUS_HOT = 'HOT';
    const STATUS_SALE_OFF = 'SALE_OFF';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_EXPIRED = 'EXPIRED';
    
    const INACTIVE = 0;

    const COLUMN_ID = 'id';
    const COLUMN_IMAGE = 'image';
    const COLUMN_ATTACHMENT = 'attachment';
    const COLUMN_NAME = 'name';
    const COLUMN_DESCRIPTION = 'description';
    const COLUMN_CONTENT = 'content';
    const COLUMN_CATEGORY_ID = 'category_id';
    const COLUMN_QUANTITY = 'quantity';
    const COLUMN_PRICE = 'price';
    const COLUMN_SALE_PRICE = 'sale_price';
    const COLUMN_DISCOUNT = 'discount';
    const COLUMN_DISCOUNT_RATE = 'discount_rate';
    const COLUMN_DISCOUNT_EXPIRED = 'discount_expired';
    const COLUMN_IS_ONLINE = 'is_online';
    const COLUMN_ONLINE_STARTED = 'online_started';
    const COLUMN_ONLINE_DURATION = 'online_duration';
    const COLUMN_IS_PREMIUM = 'is_premium';
    const COLUMN_IS_RENEW = 'is_renew';
    const COLUMN_STATUS = 'status';
    const COLUMN_IS_ACTIVE = 'is_active';
    const COLUMN_LAT = 'lat';
    const COLUMN_LONG = 'long';
    const COLUMN_COUNTRY = 'country';
    const COLUMN_STATE = 'state';
    const COLUMN_CITY = 'city';
    const COLUMN_ADDRESS = 'address';
    const COLUMN_SELLER_ID = 'seller_id';
    const COLUMN_VIEW_COUNT = 'view_count';
    const COLUMN_LIKE_COUNT = 'like_count';
    const COLUMN_RATE = 'rate';
    const COLUMN_RATE_COUNT = 'rate_count';
    const COLUMN_RESERVATION_COUNT = 'reservation_count';
    const COLUMN_CREATED_DATE = 'created_date';
    const COLUMN_CREATED_USER = 'created_user';
    const COLUMN_MODIFIED_DATE = 'modified_date';
    const COLUMN_MODIFIED_USER = 'modified_user';
    const COLUMN_APPLICATION_ID = 'application_id';

    /**
    * @inheritdoc
    */
    public $tableName = 'product_deal';

    public static function tableName()
    {
        return 'product_deal';
    }

    
}
