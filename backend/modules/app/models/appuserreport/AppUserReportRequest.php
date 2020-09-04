<?php

namespace backend\modules\app\models\appuserreport;

class AppUserReportRequest extends AppUserReportRequestBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['buyer_id', 'seller_id', 'order_id', 'product_id'], 'required'],
            [['buyer_id', 'seller_id', 'order_id', 'product_id', 'status'], 'integer'],
            [['note'], 'string'],
            [['created_at', 'modified_at'], 'safe'],                
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
            'status' => 'Status',
            'note' => 'Note',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
