<?php

namespace backend\modules\app\models\appuserrefund;

use Yii;

/**
 * @property integer $id
 * @property integer $buyer_id
 * @property integer $seller_id
 * @property integer $order_id
 * @property integer $product_id
 * @property double $amount
 * @property integer $status
 * @property string $type
 * @property string $note
 * @property string $time
 * @property string $created_at
 * @property string $modified_at
 */
class AppUserRefundRequestBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_refund_request';

    public static function tableName()
    {
        return 'app_user_refund_request';
    }

    public static function getStatusLabel($status)
    {
        $types = array( 
            1 => 'Approved',
            0 => 'Processing',
            -1 => 'Rejected',
            2 => 'Canceled',
        );
        return $types[$status];
    }
}
