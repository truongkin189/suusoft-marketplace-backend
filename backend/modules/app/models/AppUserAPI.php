<?php

namespace backend\modules\app\models;

use backend\modules\transport\models\TransportDriverAPI;
use backend\modules\transport\models\TransportVehicleAPI;
use common\components\FHtml;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "app_user".
 *
 * @property AppUserReviewAPI[] $toMeReviews
 * @property AppUserReviewAPI[] $toMeBasicReviews
 * @property AppUserReviewAPI[] $byMeReviews
 * @property AppUserDeviceAPI[] $devices
 * @property AppUserSettingAPI[] $setting
 * @property AppUserProAPI $pro
 * @property TransportDriverAPI $driver
 * @property TransportVehicleAPI $vehicle
 * @property AppUserTokenAPI $loginToken
 */
class AppUserAPI extends AppUserBase
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_USER = 10;
    const ROLE_MODERATOR = 20;
    const ROLE_ADMIN = 30;
    public $pro_data;
    public $driver_data;
    public $vehicle_data;
    public $is_secured;
    public $avg_rate;
    public $total_rate_count;
    public $listProducts = array();


    public function fields()
    {
        //$fields = parent::fields();
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
        
                if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
                    $avatar_link =  $this->avatar;
                }else{
                    if(!isset($this->avatar) || strlen($this->avatar) == 0){
                        $avatar_link = "";
                    }else{
                        $avatar_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->avatar, 'd' => APP_USER_DIR, 's'=>'thumb']);
                    }
                }
        
                $this->avatar = $avatar_link;
                $this->is_secured = isset($this->password) && strlen($this->password)!= 0 ? 1 : 0;
        
                // $vehicle_data = $this->vehicle;
                // $driver_data = $this->driver;
                $pro_data = $this->pro;
                $this->pro_data = $pro_data;
                // $this->driver_data = $driver_data;
                // $this->vehicle_data = $vehicle_data;
        
                if(!isset($pro_data)){
                    $this->avg_rate = $this->rate;
                    $this->total_rate_count = $this->rate_count;
                }else{
                    $total = $this->rate;
                    $count = $this->rate_count;
                    $pro_count = $pro_data->rate_count;
        
                    if($pro_count != 0){
                        $pro_rate = $pro_data->rate;
        
                        $total += $pro_rate;
                        $new_count = $count + $pro_count;
                        if($count!=0){
                            $this->avg_rate = $total/2;
                        }else{
                            $this->avg_rate = $total;
                        }
                        $this->total_rate_count = $new_count;
                    }else{
                        $this->avg_rate = $total;
                        $this->total_rate_count = $count;
                    }
                }

                $this->listProducts = $this->productsBySellerId;
        
                $fields = array_merge($fields, [
                    'is_secured',
                    'pro_data', 
                    // 'driver_data', 
                    // 'vehicle_data', 
                    'avg_rate', 
                    'total_rate_count',
                    'listProducts'
                    ]);
                return $fields;
    }
        
    

//    public function afterFind()
//    {
//        $this->avatar = FHtml::getFileURL($this->avatar, APP_USER_DIR, BACKEND, \Globals::NO_IMAGE);
//    }

    /**
     * @inheritdoc
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'is_active' => self::STATUS_ACTIVE]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'is_active' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotFoundHttpException();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public static function isAdmin($role)
    {
        return $role == self::ROLE_ADMIN;
    }

    public static function isModerator($role)
    {
        return $role == self::ROLE_MODERATOR;
    }

    public static function isNormalUser($role)
    {
        return $role == self::ROLE_USER;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function findUser($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }


    //connections

    public function getDevices()
    {
        return $this->hasMany(AppUserDeviceAPI::className(), ['user_id' => 'id']);
    }

    public function getSetting()
    {
        return $this->hasOne(AppUserSettingAPI::className(), ['user_id' => 'id']);
    }

    public function getPro()
    {
        return $this->hasOne(AppUserProAPI::className(), ['user_id' => 'id']);
    }

    public function getDriver()
    {
        return $this->hasOne(TransportDriverAPI::className(), ['user_id' => 'id']);
    }

    public function getVehicle()
    {
        return $this->hasOne(TransportVehicleAPI::className(), ['user_id' => 'id']);
    }

    public function getLoginToken()
    {
        return $this->hasOne(AppUserTokenAPI::className(), ['user_id' => 'id']);
    }

     public function getToMeBasicReviews()
    {
        return $this->hasMany(AppUserReviewAPI::className(), ['destination_id' => 'id'])
            ->andOnCondition(['or',
                ['destination_role' => \Globals::ROLE_BUYER],
                ['destination_role' => \Globals::ROLE_PASSENGER]
            ]);
    }

/*
    public function getByMeReviews()
    {
        return $this->hasMany(AppUserReviewAPI::className(), ['author_id' => 'id']);
    }
*/
    public function getByMeReviews()
    {
        return $this->hasMany(AppUserReviewAPI::className(), ['author_id' => 'id'])
            ->andOnCondition(['or',
                ['destination_role' => \Globals::ROLE_BUYER],
                ['destination_role' => \Globals::ROLE_PASSENGER]
            ]);
    }
}
