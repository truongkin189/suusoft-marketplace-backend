<?php

namespace backend\modules\app\models;

use Yii;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $friend_id
 */
class AppUserFriendBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_friend';

    public static function tableName()
    {
        return 'app_user_friend';
    }

}
