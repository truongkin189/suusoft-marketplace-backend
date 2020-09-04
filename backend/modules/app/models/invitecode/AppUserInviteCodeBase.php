<?php

namespace backend\modules\app\models\invitecode;

use backend\modules\app\models\AppUser;

use Yii;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $invite_code
 * @property string $created_at
 * @property integer $status
 */
class AppUserInviteCodeBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_invite_code';

    public static function tableName()
    {
        return 'app_user_invite_code';
    }

    public static function getStatusLabel($status)
    {
        $types = array( 
            1 => 'Approved',
            0 => 'Processing',
            -1 => 'Rejected',
        );
        return $types[$status];
    }
    
    public static function getUserInvited($user_id)
    {
        $user = AppUser::findOne(['id' => $user_id]);
     
        return $user->username;
    }
}
