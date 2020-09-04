<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;

/**
* Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the model class for table "app_user_transaction_request".
 *

 * @property integer $id
 * @property integer $user_id
 * @property integer $destination_id
 * @property double $amount
 * @property string $type
 * @property string $note
 * @property integer $status
 * @property string $time
 * @property string $created_date
 * @property string $modified_date
 */
class AppUserTransactionRequestBase extends \yii\db\ActiveRecord
{
    const TYPE_REDEEM = 'redeem';
    const TYPE_TRANSFER = 'transfer';
    const TYPE_EXCHANGE = 'exchange';
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = -1;

// id, user_id, destination_id, amount, type, note, status, time, created_date, modified_date
    const COLUMN_ID = 'id';
    const COLUMN_USER_ID = 'user_id';
    const COLUMN_DESTINATION_ID = 'destination_id';
    const COLUMN_AMOUNT = 'amount';
    const COLUMN_TYPE = 'type';
    const COLUMN_NOTE = 'note';
    const COLUMN_STATUS = 'status';
    const COLUMN_TIME = 'time';
    const COLUMN_CREATED_DATE = 'created_date';
    const COLUMN_MODIFIED_DATE = 'modified_date';

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_transaction_request';

    public static function tableName()
    {
        return 'app_user_transaction_request';
    }
}
