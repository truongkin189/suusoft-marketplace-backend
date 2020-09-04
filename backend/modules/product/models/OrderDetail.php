<?php

namespace backend\modules\product\models;

class OrderDetail extends OrderDetailBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['orderId', 'productId', 'productName', 'quantity', 'price', 'subTotal'], 'required'],
            [['orderId', 'productId', 'classId', 'quantity'], 'integer'],
            [['startDate', 'endDate'], 'safe'],
            [['schedule'], 'string'],
            [['price', 'subTotal'], 'number'],
            [['productName', 'class', 'color', 'size'], 'string', 'max' => 255],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => 'Order ID',
            'productId' => 'Product ID',
            'productName' => 'Product Name',
            'classId' => 'Class ID',
            'class' => 'Class',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'schedule' => 'Schedule',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'subTotal' => 'Sub Total',
            'color' => 'Color',
            'size' => 'Size',
        ];
    }
}
