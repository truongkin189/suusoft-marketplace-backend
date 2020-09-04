<?php

namespace backend\modules\subscribe\models;

use Yii;

/**
 * @property integer $id
 * @property integer $subscriber_id
 * @property integer $subscribed_id
 * @property string $created_at
 * @property string $modified_at
 */
class SubscribeBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'subscribe';

    public static function tableName()
    {
        return 'subscribe';
    }

}
