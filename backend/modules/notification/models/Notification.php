<?php

namespace backend\modules\notification\models;

class Notification extends NotificationBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['message'], 'required'],
            [['message'], 'string'],
            [['buyer_all', 'seller_all', 'buyer_only', 'buyer_id', 'seller_only', 'seller_id'], 'integer'],
            [['created_at'], 'safe'],
            [['person_push_name'], 'string', 'max' => 5],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_push_name' => 'Person Push Name',
            'message' => 'Message',
            'buyer_all' => 'Buyer All',
            'seller_all' => 'Seller All',
            'buyer_only' => 'Buyer Only',
            'buyer_id' => 'Buyer ID',
            'seller_only' => 'Seller Only',
            'seller_id' => 'Seller ID',
            'created_at' => 'Created At',
        ];
    }
}
