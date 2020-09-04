<?php

namespace backend\modules\app\models;

use Yii;

/**
 * @property integer $id
 * @property string $username
 * @property string $image
 * @property string $overview
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property string $application_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserBase extends \yii\db\ActiveRecord
{
    const ROLE_ADMIN = 'ADMIN';
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 10;

    /**
    * @inheritdoc
    */
    public $tableName = 'user';

    public static function tableName()
    {
        return 'user';
    }

}
