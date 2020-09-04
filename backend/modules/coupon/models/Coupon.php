<?php

namespace backend\modules\coupon\models;

class Coupon extends CouponBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['code', 'discount_amount'], 'required'],
            [['discount_amount', 'is_active'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['code', 'created_by'], 'string', 'max' => 255],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'discount_amount' => 'Discount Amount',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
