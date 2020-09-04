<?php

namespace backend\modules\app\models\appuserrefund;

class AppUserRefundRequest extends AppUserRefundRequestBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['buyer_id', 'seller_id', 'order_id', 'product_id', 'amount', 'status', 'type', 'created_at'], 'required'],
            [['buyer_id', 'seller_id', 'order_id', 'product_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['note'], 'string'],
            [['created_at', 'modified_at'], 'safe'],
            [['type'], 'string', 'max' => 255],
            [['time'], 'string', 'max' => 20],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'buyer_id' => 'Buyer ID',
            'seller_id' => 'Seller ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'amount' => 'Amount',
            'status' => 'Status',
            'type' => 'Type',
            'note' => 'Note',
            'time' => 'Time',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
