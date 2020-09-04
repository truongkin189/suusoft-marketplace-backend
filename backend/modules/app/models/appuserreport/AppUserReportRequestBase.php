<?php

namespace backend\modules\app\models\appuserreport;
use backend\modules\app\models\imagereport\AppUserReportImage;

use Yii;

/**
 * @property integer $id
 * @property integer $buyer_id
 * @property integer $seller_id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $status
 * @property string $note
 * @property string $created_at
 * @property string $modified_at
 */
class AppUserReportRequestBase extends \yii\db\ActiveRecord
{
    public $image;
    /**
    * @inheritdoc
    */
    public $tableName = 'app_user_report_request';

    public static function tableName()
    {
        return 'app_user_report_request';
    }

    public static function getStatusLabel($status)
    {
        $types = array( 
             1 => 'Approved',
            0 => 'Processing',
            -1 => 'Rejected',
            2 => 'Canceled',

        );
        return $types[$status];
    }

    public function getAllImage()
    {
        return $this->hasMany(AppUserReportImage::className(), ['report_id' => 'id']);
    }
}
