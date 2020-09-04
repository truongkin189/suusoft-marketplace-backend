<?php

namespace backend\modules\transport\models;
/**
 * @property TransportDriverAPI $driver
 * @property TransportVehicle $vehicle

 */
class TransportDriver extends TransportDriverBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['user_id', 'is_active'], 'required'],
            [['user_id', 'driver_experience', 'online_duration', 'is_delivery', 'is_online', 'is_active','is_sos'], 'integer'],
            [['fare'], 'number'],
            [['created_date', 'modified_date'], 'safe'],
            [['driver_license'], 'string', 'max' => 255],
            [['online_started'], 'string', 'max' => 20],
            [['type'], 'string', 'max' => 100],
            [['user_id'], 'unique'],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'driver_experience' => 'Driver Experience',
            'driver_license' => 'Driver License',
            'online_started' => 'Online Started',
            'online_duration' => 'Online Duration',
            'fare' => 'Fare',
            'type' => 'Type',
            'is_delivery' => 'Is Delivery',
            'is_online' => 'Is Online',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }

    public function getVehicle()
    {
        return $this->hasOne(TransportVehicle::className(), ['user_id' => 'user_id']);
    }
}
