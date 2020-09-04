<?php

namespace backend\modules\transport\models;

use Yii;

/**
 * @property integer $user_id
 * @property integer $driver_experience
 * @property string $driver_license
 * @property string $online_started
 * @property integer $online_duration
 * @property double $fare
 * @property string $fare_type
 * @property string $type
 * @property integer $is_delivery
 * @property integer $is_online
 * @property integer $is_active
 * @property string $created_date
 * @property string $modified_date
 */
class TransportDriverBase extends \yii\db\ActiveRecord
{
    const FARE_TYPE_MANUAL = 'manual';
    const FARE_TYPE_AUTO = 'auto';
    const TYPE_TAXI = 'taxi';
    const TYPE_VIP = 'vip';
    const TYPE_LIFT = 'lift';
    const TYPE_MOTO = 'moto';

    /**
    * @inheritdoc
    */
    public $tableName = 'transport_driver';

    public static function tableName()
    {
        return 'transport_driver';
    }

}
