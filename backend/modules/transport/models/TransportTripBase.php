<?php

namespace backend\modules\transport\models;

use Yii;
use common\components\FHtml;

/**
* Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the model class for table "transport_trip".
 *

 * @property integer $id
 * @property integer $passenger_id
 * @property integer $passenger_visible
 * @property integer $passenger_confirm
 * @property integer $passenger_rated
 * @property integer $passenger_finished
 * @property integer $driver_id
 * @property integer $driver_visible
 * @property integer $driver_confirm
 * @property integer $driver_rated
 * @property integer $driver_finished
 * @property string $seat_count
 * @property string $start_time
 * @property string $end_time
 * @property string $start_lat
 * @property string $start_long
 * @property string $start_location
 * @property string $end_lat
 * @property string $end_long
 * @property string $end_location
 * @property double $distance
 * @property string $time
 * @property string $status
 * @property integer $is_active
 * @property string $estimate_duration
 * @property string $estimate_distance
 * @property double $estimate_fare
 * @property double $actual_fare
 * @property string $payment_method
 * @property integer $payment_status
 * @property string $created_date
 * @property string $modified_date
 */
class TransportTripBase extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_FINISHED = 'finished';
    const STATUS_CANCELLED = 'cancelled';

// id, passenger_id, passenger_visible, passenger_confirm, passenger_rated, driver_id, driver_visible, driver_confirm, driver_rated, seat_count, start_time, end_time, start_lat, start_long, start_location, end_lat, end_long, end_location, distance, time, status, is_active, estimate_duration, estimate_distance, estimate_fare, actual_fare, payment_method, payment_status, created_date, modified_date
    const COLUMN_ID = 'id';
    const COLUMN_PASSENGER_ID = 'passenger_id';
    const COLUMN_PASSENGER_VISIBLE = 'passenger_visible';
    const COLUMN_PASSENGER_CONFIRM = 'passenger_confirm';
    const COLUMN_PASSENGER_RATED = 'passenger_rated';
    const COLUMN_PASSENGER_FINISHED = 'passenger_finished';
    const COLUMN_DRIVER_ID = 'driver_id';
    const COLUMN_DRIVER_VISIBLE = 'driver_visible';
    const COLUMN_DRIVER_CONFIRM = 'driver_confirm';
    const COLUMN_DRIVER_RATED = 'driver_rated';
    const COLUMN_DRIVER_FINISHED = 'driver_finished';
    const COLUMN_SEAT_COUNT = 'seat_count';
    const COLUMN_START_TIME = 'start_time';
    const COLUMN_END_TIME = 'end_time';
    const COLUMN_START_LAT = 'start_lat';
    const COLUMN_START_LONG = 'start_long';
    const COLUMN_START_LOCATION = 'start_location';
    const COLUMN_END_LAT = 'end_lat';
    const COLUMN_END_LONG = 'end_long';
    const COLUMN_END_LOCATION = 'end_location';
    const COLUMN_DISTANCE = 'distance';
    const COLUMN_TIME = 'time';
    const COLUMN_STATUS = 'status';
    const COLUMN_IS_ACTIVE = 'is_active';
    const COLUMN_ESTIMATE_DURATION = 'estimate_duration';
    const COLUMN_ESTIMATE_DISTANCE = 'estimate_distance';
    const COLUMN_ESTIMATE_FARE = 'estimate_fare';
    const COLUMN_ACTUAL_FARE = 'actual_fare';
    const COLUMN_PAYMENT_METHOD = 'payment_method';
    const COLUMN_PAYMENT_STATUS = 'payment_status';
    const COLUMN_CREATED_DATE = 'created_date';
    const COLUMN_MODIFIED_DATE = 'modified_date';

    /**
    * @inheritdoc
    */
    public $tableName = 'transport_trip';

    public static function tableName()
    {
        return 'transport_trip';
    }



    /**
     * @inheritdoc
     * @return TransportTripQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransportTripQuery(get_called_class());
    }
}
