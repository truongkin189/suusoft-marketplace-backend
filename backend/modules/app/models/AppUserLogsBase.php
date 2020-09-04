<?php

namespace backend\modules\app\models;

use Yii;

/**
 * @property integer $id
 * @property string $user_id
 * @property string $action
 * @property integer $duration
 * @property string $destination_id
 * @property string $created_date
 * @property string $modified_date
 * @property string $application_id
 */
class AppUserLogsBase extends \yii\db\ActiveRecord
{
    const ACTION_REGISTER = 'register';
    const ACTION_LOGIN = 'login';
    const ACTION_PURCHASE = 'purchase';
    const ACTION_FEEDBACK = 'feedback';
    const ACTION_GIFT = 'gift';

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_logs';

    public static function tableName()
    {
        return 'app_user_logs';
    }

}
