<?php

namespace backend\modules\coupon\models;

use Yii;

/**
 * @property integer $id
 * @property string $code
 * @property integer $discount_amount
 * @property integer $is_active
 * @property string $created_by
 * @property string $created_at
 * @property string $modified_at
 */
class CouponBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'coupon';

    public static function tableName()
    {
        return 'coupon';
    }

}
