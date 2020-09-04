<?php

namespace backend\modules\transport\models;

class TransportVehicle extends TransportVehicleBase
{

    public $image_file;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['user_id'], 'required'],
            [['user_id', 'yearly_km', 'yearly_insurance', 'yearly_maintenance', 'yearly_tax', 'yearly_gara', 'yearly_unexpected', 'year_intend', 'price_4_new_tyres', 'sold_value', 'bought_value'], 'integer'],
            [['average_consumption', 'fuel_unit_price'], 'number'],
            [['year', 'created_date', 'modified_date'], 'safe'],
            [['description'], 'string'],
            [['image', 'permit', 'insurance', 'fuel_type', 'plate', 'brand', 'model', 'color', 'status'], 'string', 'max' => 255],                        
            [['image_file'], 'file','skipOnEmpty' => true, 'extensions'=>'jpg, gif, png'],                        
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'image' => 'Image',
            'permit' => 'Permit',
            'insurance' => 'Insurance',
            'yearly_km' => 'Yearly Km',
            'yearly_insurance' => 'Yearly Insurance',
            'yearly_maintenance' => 'Yearly Maintenance',
            'yearly_tax' => 'Yearly Tax',
            'yearly_gara' => 'Yearly Gara',
            'yearly_unexpected' => 'Yearly Unexpected',
            'year_intend' => 'Year Intend',
            'price_4_new_tyres' => 'Price 4 New Tyres',
            'average_consumption' => 'Average Consumption',
            'fuel_unit_price' => 'Fuel Unit Price',
            'fuel_type' => 'Fuel Type',
            'sold_value' => 'Sold Value',
            'bought_value' => 'Bought Value',
            'plate' => 'Plate',
            'brand' => 'Brand',
            'model' => 'Model',
            'color' => 'Color',
            'year' => 'Year',
            'status' => 'Status',
            'description' => 'Description',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'image_file' => 'Image File',
            ];
    }
}
