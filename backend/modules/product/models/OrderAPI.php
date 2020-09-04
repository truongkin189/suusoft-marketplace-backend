<?php

namespace backend\modules\product\models;

class OrderAPI extends OrderBase
{
    public $detail;
    
    public function fields()
    {
        $fields = parent::fields();
        
        $this->detail = $this->details;
        
        return $fields;
    
        return array_merge($fields,['detail']);
    }

    public function rules()
    {
        return [];
    }

    public function getProducts()
    {
        return $this->hasMany(OrderDetail::className(), ['orderId' => 'id']);
    }
    
    public function getDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['orderId' => 'id']);
    }
}
