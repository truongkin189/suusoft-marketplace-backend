<?php

namespace backend\modules\transport\models;

use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "transport_trip".
 */
class TransportTrip extends TransportTripBase //\yii\db\ActiveRecord
{
    const LOOKUP = [        'status' => [['id' => TransportTrip::STATUS_PENDING, 'name' => 'pending'], ['id' => TransportTrip::STATUS_PROCESSING, 'name' => 'processing'], ['id' => TransportTrip::STATUS_FINISHED, 'name' => 'finished'], ['id' => TransportTrip::STATUS_CANCELLED, 'name' => 'cancelled'], ],
];

    const COLUMNS_UPLOAD = [];

    public $order_by = 'is_active desc,created_date desc,';

    const OBJECTS_RELATED = [];
    const OBJECTS_META = [];
    const COLUMNS = [
        'api' => ['id', 'passenger_id', 'passenger_visible', 'passenger_confirm', 'passenger_rated', 'driver_id', 'driver_visible', 'driver_confirm', 'driver_rated', 'seat_count', 'start_time', 'end_time', 'start_lat', 'start_long', 'start_location', 'end_lat', 'end_long', 'end_location', 'distance', 'time', 'status', 'is_active', 'estimate_duration', 'estimate_distance', 'estimate_fare', 'actual_fare', 'payment_method', 'payment_status', 'created_date', 'modified_date', ],
        'all' => ['id', 'passenger_id', 'passenger_visible', 'passenger_confirm', 'passenger_rated', 'driver_id', 'driver_visible', 'driver_confirm', 'driver_rated', 'seat_count', 'start_time', 'end_time', 'start_lat', 'start_long', 'start_location', 'end_lat', 'end_long', 'end_location', 'distance', 'time', 'status', 'is_active', 'estimate_duration', 'estimate_distance', 'estimate_fare', 'actual_fare', 'payment_method', 'payment_status', 'created_date', 'modified_date',  'objectAttributes', 'objectFile', 'objectCategories'],
        '+' => [  'objectAttributes', 'objectFile', 'objectCategories']
    ];

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
        
            [['id', 'passenger_id', 'passenger_visible', 'passenger_confirm', 'passenger_rated', 'driver_id', 'driver_visible', 'driver_confirm', 'driver_rated', 'seat_count', 'start_time', 'end_time', 'start_lat', 'start_long', 'start_location', 'end_lat', 'end_long', 'end_location', 'distance', 'time', 'status', 'is_active', 'estimate_duration', 'estimate_distance', 'estimate_fare', 'actual_fare', 'payment_method', 'payment_status', 'created_date', 'modified_date'], 'filter', 'filter' => 'trim'],
                
            [['passenger_id', 'seat_count', 'is_active'], 'required'],
            [['passenger_id', 'passenger_visible', 'passenger_confirm', 'passenger_rated', 'driver_id', 'driver_visible', 'driver_confirm', 'driver_rated', 'is_active', 'payment_status'], 'integer'],
            [['start_time', 'end_time', 'created_date', 'modified_date'], 'safe'],
            [['distance', 'estimate_fare', 'actual_fare'], 'number'],
            [['seat_count'], 'string', 'max' => 3],
            [['start_lat', 'start_long', 'end_lat', 'end_long', 'time', 'estimate_duration', 'estimate_distance', 'payment_method'], 'string', 'max' => 20],
            [['start_location', 'end_location'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 100],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
                    'id' => FHtml::t('TransportTrip', 'ID'),
                    'passenger_id' => FHtml::t('TransportTrip', 'Passenger ID'),
                    'passenger_visible' => FHtml::t('TransportTrip', 'Passenger Visible'),
                    'passenger_confirm' => FHtml::t('TransportTrip', 'Passenger Confirm'),
                    'passenger_rated' => FHtml::t('TransportTrip', 'Passenger Rated'),
                    'driver_id' => FHtml::t('TransportTrip', 'Driver ID'),
                    'driver_visible' => FHtml::t('TransportTrip', 'Driver Visible'),
                    'driver_confirm' => FHtml::t('TransportTrip', 'Driver Confirm'),
                    'driver_rated' => FHtml::t('TransportTrip', 'Driver Rated'),
                    'seat_count' => FHtml::t('TransportTrip', 'Seat Count'),
                    'start_time' => FHtml::t('TransportTrip', 'Start Time'),
                    'end_time' => FHtml::t('TransportTrip', 'End Time'),
                    'start_lat' => FHtml::t('TransportTrip', 'Start Lat'),
                    'start_long' => FHtml::t('TransportTrip', 'Start Long'),
                    'start_location' => FHtml::t('TransportTrip', 'Start Location'),
                    'end_lat' => FHtml::t('TransportTrip', 'End Lat'),
                    'end_long' => FHtml::t('TransportTrip', 'End Long'),
                    'end_location' => FHtml::t('TransportTrip', 'End Location'),
                    'distance' => FHtml::t('TransportTrip', 'Distance'),
                    'time' => FHtml::t('TransportTrip', 'Time'),
                    'status' => FHtml::t('TransportTrip', 'Status'),
                    'is_active' => FHtml::t('TransportTrip', 'Is Active'),
                    'estimate_duration' => FHtml::t('TransportTrip', 'Estimate Duration'),
                    'estimate_distance' => FHtml::t('TransportTrip', 'Estimate Distance'),
                    'estimate_fare' => FHtml::t('TransportTrip', 'Estimate Fare'),
                    'actual_fare' => FHtml::t('TransportTrip', 'Actual Fare'),
                    'payment_method' => FHtml::t('TransportTrip', 'Payment Method'),
                    'payment_status' => FHtml::t('TransportTrip', 'Payment Status'),
                    'created_date' => FHtml::t('TransportTrip', 'Created Date'),
                    'modified_date' => FHtml::t('TransportTrip', 'Modified Date'),
                ];
    }




    public function prepareCustomFields() {
        parent::prepareCustomFields();

    }

    public function fields()
    {
        $fields = parent::fields();

        $columns = self::COLUMNS;
        if (is_string($this->columnsMode) && !empty($this->columnsMode) && key_exists($this->columnsMode, $columns)) {
            $fields1 = $columns[$this->columnsMode];
            if (!empty($fields1))
            $fields = $fields1;
        } else if (is_array($this->columnsMode))
            $fields = $this->columnsMode;

        if (key_exists('+', $columns) && !empty($columns['+'])) {
            $fields = array_merge($fields, $columns['+']);
        }
        //unset($fields['xxx'], $fields['yyy'], $fields['zzz']);

        return $fields;
    }

    public static function getLookupArray($column) {
        if (key_exists($column, self::LOOKUP))
            return self::LOOKUP[$column];
        return [];
    }

    public static function getRelatedObjects() {
        return self::OBJECTS_RELATED;
    }

    public static function getMetaObjects() {
        return self::OBJECTS_META;
    }

    public static function tableSchema()
    {
        return FHtml::getTableSchema(self::tableName());
    }

    public static function Columns()
    {
        return self::tableSchema()->columns;
    }

    public static function ColumnsArray()
    {
        return ArrayHelper::getColumn(self::tableSchema()->columns, 'name');
    }


    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['TransportTrip*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@backend/messages',
            'fileMap' => [
                'TransportTrip' => 'TransportTrip.php',
            ],
        ];
    }

    public function toViewModel() {
    $model = new ViewModel();
            FHtml::setFieldValue($model, ['id'], $this->id);
            FHtml::setFieldValue($model, ['passenger_id'], $this->passenger_id);
            FHtml::setFieldValue($model, ['passenger_visible'], $this->passenger_visible);
            FHtml::setFieldValue($model, ['passenger_confirm'], $this->passenger_confirm);
            FHtml::setFieldValue($model, ['passenger_rated'], $this->passenger_rated);
            FHtml::setFieldValue($model, ['driver_id'], $this->driver_id);
            FHtml::setFieldValue($model, ['driver_visible'], $this->driver_visible);
            FHtml::setFieldValue($model, ['driver_confirm'], $this->driver_confirm);
            FHtml::setFieldValue($model, ['driver_rated'], $this->driver_rated);
            FHtml::setFieldValue($model, ['seat_count'], $this->seat_count);
            FHtml::setFieldValue($model, ['start_time'], $this->start_time);
            FHtml::setFieldValue($model, ['end_time'], $this->end_time);
            FHtml::setFieldValue($model, ['start_lat'], $this->start_lat);
            FHtml::setFieldValue($model, ['start_long'], $this->start_long);
            FHtml::setFieldValue($model, ['start_location'], $this->start_location);
            FHtml::setFieldValue($model, ['end_lat'], $this->end_lat);
            FHtml::setFieldValue($model, ['end_long'], $this->end_long);
            FHtml::setFieldValue($model, ['end_location'], $this->end_location);
            FHtml::setFieldValue($model, ['distance'], $this->distance);
            FHtml::setFieldValue($model, ['time'], $this->time);
            FHtml::setFieldValue($model, ['status'], $this->status);
            FHtml::setFieldValue($model, ['is_active'], $this->is_active);
            FHtml::setFieldValue($model, ['estimate_duration'], $this->estimate_duration);
            FHtml::setFieldValue($model, ['estimate_distance'], $this->estimate_distance);
            FHtml::setFieldValue($model, ['estimate_fare'], $this->estimate_fare);
            FHtml::setFieldValue($model, ['actual_fare'], $this->actual_fare);
            FHtml::setFieldValue($model, ['payment_method'], $this->payment_method);
            FHtml::setFieldValue($model, ['payment_status'], $this->payment_status);
            FHtml::setFieldValue($model, ['created_date'], $this->created_date);
            FHtml::setFieldValue($model, ['modified_date'], $this->modified_date);
        return $model;
    }
}
