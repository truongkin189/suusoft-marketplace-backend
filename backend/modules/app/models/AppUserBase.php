<?php

namespace backend\modules\app\models;

use backend\modules\product\models\ProductDealAPI;


use Yii;
use common\components\FHtml;


/**
* Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the model class for table "app_user".
 *

 * @property integer $id
 * @property integer $qb_id
 * @property string $avatar
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $description
 * @property string $content
 * @property string $gender
 * @property string $dob
 * @property string $phone
 * @property string $weight
 * @property string $height
 * @property string $address
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $balance
 * @property integer $point
 * @property string $card_number
 * @property string $card_cvv
 * @property string $card_exp
 * @property string $lat
 * @property string $long
 * @property integer $is_online
 * @property integer $is_active
 * @property string $type
 * @property string $status
 * @property integer $role
 * @property double $rate
 * @property integer $rate_count
 * @property string $created_date
 * @property string $modified_date
 */
class AppUserBase extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 'PENDING';
    const STATUS_BANNED = 'BANNED';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_NORMAL = 'NORMAL';
    const STATUS_PRO = 'PRO';
    const STATUS_VIP = 'VIP';
    const ROLE_ADMIN = 'ADMIN';

// id, qb_id, avatar, name, username, email, password, auth_key, password_hash, password_reset_token, description, content, gender, dob, phone, weight, height, address, country, state, city, balance, point, card_number, card_cvv, card_exp, lat, long, is_online, is_active, type, status, role, rate, rate_count, created_date, modified_date
    const COLUMN_ID = 'id';
    const COLUMN_QB_ID = 'qb_id';
    const COLUMN_AVATAR = 'avatar';
    const COLUMN_NAME = 'name';
    const COLUMN_USERNAME = 'username';
    const COLUMN_EMAIL = 'email';
    const COLUMN_PASSWORD = 'password';
    const COLUMN_AUTH_KEY = 'auth_key';
    const COLUMN_PASSWORD_HASH = 'password_hash';
    const COLUMN_PASSWORD_RESET_TOKEN = 'password_reset_token';
    const COLUMN_DESCRIPTION = 'description';
    const COLUMN_CONTENT = 'content';
    const COLUMN_GENDER = 'gender';
    const COLUMN_DOB = 'dob';
    const COLUMN_PHONE = 'phone';
    const COLUMN_WEIGHT = 'weight';
    const COLUMN_HEIGHT = 'height';
    const COLUMN_ADDRESS = 'address';
    const COLUMN_COUNTRY = 'country';
    const COLUMN_STATE = 'state';
    const COLUMN_CITY = 'city';
    const COLUMN_BALANCE = 'balance';
    const COLUMN_POINT = 'point';
    const COLUMN_CARD_NUMBER = 'card_number';
    const COLUMN_CARD_CVV = 'card_cvv';
    const COLUMN_CARD_EXP = 'card_exp';
    const COLUMN_LAT = 'lat';
    const COLUMN_LONG = 'long';
    const COLUMN_IS_ONLINE = 'is_online';
    const COLUMN_IS_ACTIVE = 'is_active';
    const COLUMN_TYPE = 'type';
    const COLUMN_STATUS = 'status';
    const COLUMN_ROLE = 'role';
    const COLUMN_RATE = 'rate';
    const COLUMN_RATE_COUNT = 'rate_count';
    const COLUMN_CREATED_DATE = 'created_date';
    const COLUMN_MODIFIED_DATE = 'modified_date';

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user';

    public static function tableName()
    {
        return 'app_user';
    }

    public function getProductsBySellerId()
    {
        return $this->hasMany(ProductDealAPI::className(), ['seller_id' => 'id']);
    }

}
