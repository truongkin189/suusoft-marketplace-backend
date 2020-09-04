<?php

namespace backend\modules\object\models;

class ObjectCategory extends ObjectCategoryBase
{

    public $image_file;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['parent_id', 'sort_order', 'is_active', 'is_top', 'is_hot'], 'integer'],
            [['name', 'is_active', 'object_type'], 'required'],
            [['description'], 'string'],
            [['created_date', 'modified_date'], 'safe'],
            [['image', 'name'], 'string', 'max' => 255],
            [['object_type'], 'string', 'max' => 50],                        
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
            'parent_id' => 'Parent ID',
            'image' => 'Image',
            'name' => 'Name',
            'description' => 'Description',
            'sort_order' => 'Sort Order',
            'is_active' => 'Is Active',
            'is_top' => 'Is Top',
            'is_hot' => 'Is Hot',
            'object_type' => 'Object Type',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'image_file' => 'Image File',
            ];
    }
}
