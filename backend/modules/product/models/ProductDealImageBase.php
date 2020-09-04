<?php

namespace backend\modules\product\models;

use Yii;

/**
 * @property integer $id
 * @property integer $product_deal_id
 * @property string $image
 * @property string $created_at
 * @property string $modified_at
 */
class ProductDealImageBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'product_deal_image';

    public static function tableName()
    {
        return 'product_deal_image';
    }

}
