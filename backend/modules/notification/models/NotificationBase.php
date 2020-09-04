<?php

namespace backend\modules\notification\models;

use Yii;

/**
 * @property integer $id
 * @property string $person_push_name
 * @property string $message
 * @property integer $buyer_all
 * @property integer $seller_all
 * @property integer $buyer_only
 * @property integer $buyer_id
 * @property integer $seller_only
 * @property integer $seller_id
 * @property string $created_at
 */
class NotificationBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'notification';

    public static function tableName()
    {
        return 'notification';
    }

}
