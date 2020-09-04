<?php

namespace backend\modules\app\models\imagereport;

use Yii;

/**
 * @property integer $id
 * @property integer $report_id
 * @property string $image
 * @property integer $created_at
 * @property integer $modified_at
 */
class AppUserReportImageBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_report_image';

    public static function tableName()
    {
        return 'app_user_report_image';
    }
}
