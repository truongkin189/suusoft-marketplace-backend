<?php

namespace backend\modules\object\models;

use Yii;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $image
 * @property string $name
 * @property string $description
 * @property integer $sort_order
 * @property integer $is_active
 * @property integer $is_top
 * @property integer $is_hot
 * @property string $object_type
 * @property string $created_date
 * @property string $modified_date
 */
class ObjectCategoryBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'object_category';

    public static function tableName()
    {
        return 'object_category';
    }

}
