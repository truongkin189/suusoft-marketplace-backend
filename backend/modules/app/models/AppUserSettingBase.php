<?php

namespace backend\modules\app\models;

use Yii;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $notify
 * @property integer $notify_favourite
 * @property integer $notify_transport
 * @property integer $notify_food
 * @property integer $notify_labor
 * @property integer $notify_travel
 * @property integer $notify_shopping
 * @property integer $notify_news
 * @property integer $notify_nearby
 */
class AppUserSettingBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_setting';

    public static function tableName()
    {
        return 'app_user_setting';
    }

}
