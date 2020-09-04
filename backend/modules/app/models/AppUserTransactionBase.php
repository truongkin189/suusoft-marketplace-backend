<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;


/**
* Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the model class for table "app_user_transaction".
 *

 * @property string $id
 * @property string $transaction_id
 * @property string $external_transaction_id
 * @property integer $user_id
 * @property integer $user_visible
 * @property integer $destination_id
 * @property integer $destination_visible
 * @property string $object_id
 * @property string $object_type
 * @property string $amount
 * @property string $currency
 * @property string $payment_method
 * @property string $note
 * @property string $time
 * @property string $action
 * @property string $type
 * @property string $is_active
 * @property string $created_date
 * @property string $created_user
 * @property string $modified_date
 * @property string $modified_user
 * @property string $application_id
 */
class AppUserTransactionBase extends \yii\db\ActiveRecord
{
    const PAYMENT_METHOD_POINT = 'point';
    const PAYMENT_METHOD_CREDIT = 'credit';
    const PAYMENT_METHOD_CASH = 'cash';
    const PAYMENT_METHOD_BANK = 'bank';
    const PAYMENT_METHOD_PAYPAL = 'paypal';
    const PAYMENT_METHOD_WU = 'wu';
    const ACTION_SYSTEM_ADJUST = 'system_adjust';
    const ACTION_EXCHANGE_POINT = 'exchange_point';
    const ACTION_REDEEM_POINT = 'redeem_point';
    const ACTION_TRANSFER_POINT = 'transfer_point';
    const ACTION_TRIP_PAYMENT = 'trip_payment';
    const ACTION_DEAL_PAYMENT = 'deal_payment';
    const ACTION_DEAL_ONLINE = 'deal_online';
    const ACTION_DRIVER_ONLINE = 'driver_online';
    const TYPE_PLUS = '+';
    const TYPE_MINUS = '-';
    const IS_ACTIVE_PENDING = 0;
    const IS_ACTIVE_APPROVED = 1;
    const IS_ACTIVE_REJECTED = -1;

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_transaction';

    public static function tableName()
    {
        return 'app_user_transaction';
    }

}
