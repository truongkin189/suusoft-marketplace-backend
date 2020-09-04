<?php

namespace backend\modules\app\models\imagereport;

class AppUserReportImage extends AppUserReportImageBase
{

    public $image_file;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['report_id', 'image'], 'required'],
            [['report_id', 'created_at', 'modified_at'], 'integer'],
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
            'report_id' => 'Report ID',
            'image' => 'Image',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'image_file' => 'Image File',
            ];
    }
}
