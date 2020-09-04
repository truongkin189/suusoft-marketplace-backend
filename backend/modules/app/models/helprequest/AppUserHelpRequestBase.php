<?php

namespace backend\modules\app\models\helprequest;

use Yii;

/**
 * @property integer $id
 * @property integer $topic
 * @property integer $user_id
 * @property string $question
 * @property string $answer
 * @property integer $is_top
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class AppUserHelpRequestBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_help_request';

    public static function tableName()
    {
        return 'app_user_help_request';
    }

}
