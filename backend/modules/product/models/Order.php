<?php

namespace backend\modules\product\models;

class Order extends OrderBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['paymentMethod', 'status', 'total'], 'required'],
            [['content'], 'string'],
            [['status', 'status_user', 'user_id'], 'integer'],
            [['total', 'vat', 'transportFee'], 'number'],
            [['createDate'], 'safe'],
            [['billingName', 'billingPhone', 'billingAddress', 'billingEmail', 'billingPostcode', 'shippingName', 'shippingPhone', 'shippingAddress', 'shippingEmail', 'shippingPostcode'], 'string', 'max' => 255],
            [['paymentMethod'], 'string', 'max' => 200],
            [['transportDes', 'transportType'], 'string', 'max' => 250],
            [['type_product'], 'string', 'max' => 20],
            [['token_payment'], 'string', 'max' => 100],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'billingName' => 'Billing Name',
            'billingPhone' => 'Billing Phone',
            'billingAddress' => 'Billing Address',
            'billingEmail' => 'Billing Email',
            'billingPostcode' => 'Billing Postcode',
            'shippingName' => 'Shipping Name',
            'shippingPhone' => 'Shipping Phone',
            'shippingAddress' => 'Shipping Address',
            'shippingEmail' => 'Shipping Email',
            'shippingPostcode' => 'Shipping Postcode',
            'paymentMethod' => 'Payment Method',
            'content' => 'Content',
            'status' => 'Status',
            'status_user' => 'Status User',
            'total' => 'Total',
            'vat' => 'Vat',
            'transportFee' => 'Transport Fee',
            'transportDes' => 'Transport Des',
            'transportType' => 'Transport Type',
            'user_id' => 'User ID',
            'seller_id' => 'Seller ID',
            'type_product' => 'Type Product',
            'token_payment' => 'Token Payment',
            'createDate' => 'Create Date',
        ];
    }
}
