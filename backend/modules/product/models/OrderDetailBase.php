<?php

namespace backend\modules\product\models;


use Yii;

/**
 * @property integer $id
 * @property integer $orderId
 * @property integer $productId
 * @property string $productName
 * @property integer $classId
 * @property string $class
 * @property string $startDate
 * @property string $endDate
 * @property string $schedule
 * @property integer $quantity
 * @property double $price
 * @property double $subTotal
 * @property string $color
 * @property string $size
 */
class OrderDetailBase extends \yii\db\ActiveRecord
{

    /**
    * @inheritdoc
    */
    public $tableName = 'order_detail';

    public static function tableName()
    {
        return 'order_detail';
    }

    

}
