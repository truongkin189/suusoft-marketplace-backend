<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;

/**
* Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the model class for table "app_user_review".
 *

 * @property integer $id
 * @property integer $author_id
 * @property string $author_role
 * @property integer $destination_id
 * @property string $destination_role
 * @property integer $object_id
 * @property string $object_type
 * @property string $content
 * @property double $rate
 * @property string $is_active
 * @property string $created_date
 * @property string $modified_date
 */
class AppUserReviewBase extends \yii\db\ActiveRecord
{

// id, author_id, author_role, destination_id, destination_role, object_id, object_type, content, rate, is_active, created_date, modified_date
    const COLUMN_ID = 'id';
    const COLUMN_AUTHOR_ID = 'author_id';
    const COLUMN_AUTHOR_ROLE = 'author_role';
    const COLUMN_DESTINATION_ID = 'destination_id';
    const COLUMN_DESTINATION_ROLE = 'destination_role';
    const COLUMN_OBJECT_ID = 'object_id';
    const COLUMN_OBJECT_TYPE = 'object_type';
    const COLUMN_CONTENT = 'content';
    const COLUMN_RATE = 'rate';
    const COLUMN_IS_ACTIVE = 'is_active';
    const COLUMN_CREATED_DATE = 'created_date';
    const COLUMN_MODIFIED_DATE = 'modified_date';

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_review';

    public static function tableName()
    {
        return 'app_user_review';
    }


}
