<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;

/**
* Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the model class for table "app_user_token".
 *

 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property string $time
 *
 * @property AppUserBase $user
 */
class AppUserTokenBase extends \yii\db\ActiveRecord
{

// id, user_id, token, time
    const COLUMN_ID = 'id';
    const COLUMN_USER_ID = 'user_id';
    const COLUMN_TOKEN = 'token';
    const COLUMN_TIME = 'time';

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_token';

    public static function tableName()
    {
        return 'app_user_token';
    }

}
