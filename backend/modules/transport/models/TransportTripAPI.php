<?php

namespace backend\modules\transport\models;

use backend\modules\app\models\AppUserAPI;
use Yii;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "transport_trip".
 *
 *
 * @property AppUserAPI $driver
 * @property AppUserAPI $passenger
 *
 */
class TransportTripAPI extends TransportTripBase
{
    public $driver_name;
    public $driver_avatar;
    public $driver_rate;
    public $driver_rate_count;
    public $driver_phone;
    public $driver_type;
    public $driver_is_delivery;
    public $driver_qb_id;

    public $passenger_name;
    public $passenger_avatar;
    public $passenger_rate;
    public $passenger_rate_count;
    public $passenger_phone;
    public $passenger_qb_id;

    public $passenger_data;
    public $balance;


    public function fields()
    {
        $fields = parent::fields();
        $driver_avatar_link = '';
        $passenger_avatar_link = '';
        $driver_name = '';
        $driver_rate = '';
        $driver_rate_count = '';
        $driver_phone = '';
        $driver_type = '';
        $driver_is_delivery = '';
        $driver_qb_id = '';

        $passenger_name = '';
        $passenger_rate = '';
        $passenger_rate_count = '';
        $passenger_phone = '';
        $passenger_qb_id = '';

        if(isset($this->driver)){
            $driver_qb_id = $this->driver->qb_id;
            if (filter_var($this->driver->avatar, FILTER_VALIDATE_URL)) {
                $driver_avatar_link =  $this->driver->avatar;
            }else{
                $driver_avatar_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->driver->avatar, 'd' => APP_USER_DIR, 's'=>'thumb']);
            }
            if(isset($this->driver->pro)){
                $driver_name = $this->driver->pro->business_name;
                $driver_rate = $this->driver->pro->rate;
                $driver_rate_count = $this->driver->pro->rate_count;
                $driver_phone = $this->driver->pro->business_phone;
            }

            $driver_type = $this->driver->driver->type;
            $driver_is_delivery = $this->driver->driver->is_delivery;

        }

        $this->driver_avatar = $driver_avatar_link;
        $this->driver_name = $driver_name;
        $this->driver_rate = $driver_rate;
        $this->driver_rate_count = $driver_rate_count;
        $this->driver_phone = $driver_phone;
        $this->driver_type = $driver_type;
        $this->driver_is_delivery = $driver_is_delivery;
        $this->driver_qb_id = $driver_qb_id;


        if(isset($this->passenger)){
            $passenger_qb_id = $this->passenger->qb_id;
            if (filter_var($this->passenger->avatar, FILTER_VALIDATE_URL)) {
                $passenger_avatar_link =  $this->passenger->avatar;
            }else{
                $passenger_avatar_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->passenger->avatar, 'd' => APP_USER_DIR, 's'=>'thumb']);
            }
            $passenger_name = $this->passenger->name;
            $passenger_rate = $this->passenger->rate;
            $passenger_rate_count = $this->passenger->rate_count;
            $passenger_phone = $this->passenger->phone;

        }
        $this->passenger_avatar = $passenger_avatar_link;
        $this->passenger_name = $passenger_name;
        $this->passenger_rate = $passenger_rate;
        $this->passenger_rate_count = $passenger_rate_count;
        $this->passenger_phone = $passenger_phone;
        $this->passenger_qb_id = $passenger_qb_id;

        $fields = array_merge($fields, [
            'driver_avatar',
            'driver_name',
            'driver_rate',
            'driver_rate_count',
            'driver_phone',
            'driver_type',
            'driver_is_delivery',
            'driver_qb_id',
            'passenger_avatar',
            'passenger_name',
            'passenger_rate',
            'passenger_rate_count',
            'passenger_phone',
            'balance',
            'passenger_qb_id'
        ]);

        return $fields;
    }

    public function rules()
    {
        return [];
    }

    public function getDriver()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'driver_id']);
    }
    public function getPassenger()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'passenger_id']);
    }
}
