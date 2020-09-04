<?php

namespace backend\modules\transport\models;

use Yii;
use common\components\FHtml;

/**
* Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
* Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
* MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the model class for table "transport_vehicle".
 *

 * @property integer $id
 * @property integer $user_id
 * @property string $image
 * @property string $permit
 * @property string $insurance
 * @property integer $yearly_km
 * @property integer $yearly_insurance
 * @property integer $yearly_maintenance
 * @property integer $yearly_tax
 * @property integer $yearly_gara
 * @property integer $yearly_unexpected
 * @property integer $year_intend
 * @property integer $price_4_new_tyres
 * @property double $average_consumption
 * @property double $fuel_unit_price
 * @property string $fuel_type
 * @property integer $sold_value
 * @property integer $bought_value
 * @property string $plate
 * @property string $brand
 * @property string $model
 * @property string $color
 * @property string $year
 * @property string $status
 * @property string $description
 * @property string $created_date
 * @property string $modified_date
 */
class TransportVehicleBase extends \yii\db\ActiveRecord
{
    const FUEL_TYPE_PETROL = 'pretrol';
    const FUEL_TYPE_GASONLINE = 'gasoline';

// id, user_id, image, permit, insurance, yearly_km, yearly_insurance, yearly_maintenance, yearly_tax, yearly_gara, yearly_unexpected, year_intend, price_4_new_tyres, average_consumption, fuel_unit_price, fuel_type, sold_value, bought_value, plate, brand, model, color, year, status, description, created_date, modified_date
    const COLUMN_ID = 'id';
    const COLUMN_USER_ID = 'user_id';
    const COLUMN_IMAGE = 'image';
    const COLUMN_PERMIT = 'permit';
    const COLUMN_INSURANCE = 'insurance';
    const COLUMN_YEARLY_KM = 'yearly_km';
    const COLUMN_YEARLY_INSURANCE = 'yearly_insurance';
    const COLUMN_YEARLY_MAINTENANCE = 'yearly_maintenance';
    const COLUMN_YEARLY_TAX = 'yearly_tax';
    const COLUMN_YEARLY_GARA = 'yearly_gara';
    const COLUMN_YEARLY_UNEXPECTED = 'yearly_unexpected';
    const COLUMN_YEAR_INTEND = 'year_intend';
    const COLUMN_PRICE_4_NEW_TYRES = 'price_4_new_tyres';
    const COLUMN_AVERAGE_CONSUMPTION = 'average_consumption';
    const COLUMN_FUEL_UNIT_PRICE = 'fuel_unit_price';
    const COLUMN_FUEL_TYPE = 'fuel_type';
    const COLUMN_SOLD_VALUE = 'sold_value';
    const COLUMN_BOUGHT_VALUE = 'bought_value';
    const COLUMN_PLATE = 'plate';
    const COLUMN_BRAND = 'brand';
    const COLUMN_MODEL = 'model';
    const COLUMN_COLOR = 'color';
    const COLUMN_YEAR = 'year';
    const COLUMN_STATUS = 'status';
    const COLUMN_DESCRIPTION = 'description';
    const COLUMN_CREATED_DATE = 'created_date';
    const COLUMN_MODIFIED_DATE = 'modified_date';

    /**
    * @inheritdoc
    */
    public $tableName = 'transport_vehicle';

    public static function tableName()
    {
        return 'transport_vehicle';
    }



    /**
     * @inheritdoc
     * @return TransportVehicleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransportVehicleQuery(get_called_class());
    }
}
