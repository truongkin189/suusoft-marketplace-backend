<?php

namespace backend\modules\product\models;

class ProductDealImage extends ProductDealImageBase
{

    public $image_file;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['product_deal_id', 'image'], 'required'],
            [['product_deal_id'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['image'], 'string', 'max' => 255],                        
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
            'product_deal_id' => 'Product Deal ID',
            'image' => 'Image',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'image_file' => 'Image File',
            ];
    }
}
