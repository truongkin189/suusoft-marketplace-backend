<?php

namespace backend\modules\product\models;

use Yii;

/**
 * @property integer $id
 * @property string $billingName
 * @property string $billingPhone
 * @property string $billingAddress
 * @property string $billingEmail
 * @property string $billingPostcode
 * @property string $shippingName
 * @property string $shippingPhone
 * @property string $shippingAddress
 * @property string $shippingEmail
 * @property string $shippingPostcode
 * @property string $paymentMethod
 * @property string $content
 * @property integer $status
 * @property integer $status_user
 * @property double $total
 * @property double $vat
 * @property double $transportFee
 * @property string $transportDes
 * @property string $transportType
 * @property integer $user_id
 * @property string $type_product
 * @property string $token_payment
 * @property string $createDate
 */
class OrderBase extends \yii\db\ActiveRecord
{

    const STATUS_WAITING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = -1;
    const STATUS_CANCELD = 2;
    const STATUS_PAID = 3;
    const STATUS_NOT_PAID = 4;
    const STATUS_DELIVERIED = 5;

    /**
    * @inheritdoc
    */
    public $tableName = 'order';

    public static function tableName()
    {
        return 'order';
    }

    public static function getStatusLabel($status)
    {
        $types = array( 
             1 => 'Approved',
            0 => 'Processing',
            -1 => 'Rejected',
            2 => 'Canceled',
             3 => 'Paid',
              4 => 'Not Paid',
               5 => 'Deliveried',
        );
        return $types[$status];
    }

    public function getDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['orderId' => 'id']);
    }

}
