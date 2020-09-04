<?php

namespace backend\modules\object\models;

use Yii;

class ObjectCategoryAPI extends ObjectCategoryBase
{
    public $sub_cate = array();

    public function fields()
    {
        
        $fields = parent::fields();

        $this->sub_cate = $this->cateAndSub;

        $image_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->image,'d' => OBJECT_CATEGORY_DIR]);
        
        $this->image = $image_link;
        // object ObjectCategory->image bị thay đổi

        return array_merge($fields,['sub_cate']);
    }

    public function rules()
    {
        return [];
    }

    public function getCateAndSub()
    {
        $id = $this->id;
        // $sub_image_path = (array)$this->getPathImage($id);

        $sub_cate_finding = ObjectCategory::find()
            ->where(['parent_id' => $this->id])
            ->all();
        
        foreach($sub_cate_finding as $new)
        {
            $new->image = $this->getPathImage($new->image);
        }

        return $sub_cate_finding;
    }
   
    public function getPathImage($image_name)
    {
        $image_path = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 
            'f'=> $image_name, 'd' => OBJECT_CATEGORY_DIR]);
        return $image_path;
    }
}
