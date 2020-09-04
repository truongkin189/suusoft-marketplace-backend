<?php
/**
 * Created by PhpStorm.
 * User: Quyen_Bui
 * Date: 7/7/2016
 * Time: 4:01 PM
 */

namespace backend\components;


use backend\models\MetaSetting;
use backend\models\Product;
use backend\models\ProductClothes;
use backend\models\ProductCourse;
use backend\models\ProductSetting;
use backend\models\ProductSmartphone;
use backend\models\Setting;
use yii\helpers\ArrayHelper;

class Helper
{
    //
    public static function showProductLabel($type) {
        return 'Products '. $type;
    }

    //
    public static function addNewProductMeta ($type) {
        switch ($type) {
            case 'course':
                $modelMeta = new ProductCourse();
                break;
            case 'clothes' :
                $modelMeta = new ProductClothes();
                break;
            case 'smartphone' :
                $modelMeta = new ProductSmartphone();
                break;
            default:
                $modelMeta = null;
                break;
        }

        return $modelMeta;
    }

    //
    public static function getProductMeta($id, $type) {
        switch ($type) {
            case 'course':
                $productMeta = ProductCourse::findOne(['product_id' => $id]);
                break;
            case 'clothes':
                $productMeta = ProductClothes::findOne(['product_id' => $id]);
                break;
            case 'smartphone':
                $productMeta = ProductSmartphone::findOne(['product_id' => $id]);
                break;
            default:
                $productMeta = null;
                break;
         }
        return $productMeta;
    }

    // Get list setting array of dropdownlist in product_setting
    public static function getSettingArray($module, $type) {
        $listData = array();

        $types = Setting::find()->where("module = :module AND type = :type AND is_active = :is_active ", ['module' => $module, ':type' => $type, ':is_active' => \Globals::STATE_ACTIVE])
            ->orderBy('order')
            ->all();
        if (count($types) != 0)
            $listData = ArrayHelper::map($types, 'key', 'value');

        return $listData;
    }

    //Get list setting array of dropdownlist in meta_setting
    public static function getSettingOthersArray($module, $type) {
        $listData = array();

        $types = Setting::find()->where("module = :module AND type = :type AND is_active = :is_active ", ['module' => $module, ':type' => $type, ':is_active' => \Globals::STATE_ACTIVE])
            ->orderBy('order')
            ->all();
        if (count($types) != 0)
            $listData = ArrayHelper::map($types, 'key', 'value');
        return $listData;
    }
    
    //Get objetc_type of table meta_setting
    public static function getObjectType() {
        $listData = array();

        $objectType = MetaSetting::find()->groupBy('object_type')->orderBy('object_type')->all();
        if (count($objectType) != 0) {
            $listData = ArrayHelper::map($objectType, 'object_type', 'object_type');
        }
        return $listData;
        }

    // Get Type Label
    public static function getTypeLabel($label) {
        
    }

    //Get a string with Values of a meta_key of a Module

    public static function getArrayValuesOfMetaKey($module, $metaKey) {
        $values = '';
        $metaSettings = MetaSetting::find()->where(['object_type' => $module, 'meta_key' => $metaKey, 'is_active' => '1'])->orderBy('sort_order')->all();
        if (count($metaSettings) > 0) {
            foreach ($metaSettings as $metaSetting) {
                $values .= $metaSetting->key . ', ';
            }
            $values = rtrim($values, ', ');
        }
        return $values;
    }

}