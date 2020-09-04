<?php

namespace backend\modules\transport\models;

use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "transport_vehicle".
 */
class TransportVehicleAPI extends TransportVehicleBase
{
    public function fields()
    {
        $fields = parent::fields();
//        $this->image = FHtml::getFileURL($this->image, TRANSPORT_VEHICLE_DIR, BACKEND, \Globals::NO_IMAGE);
//        $this->permit = FHtml::getFileURL($this->permit, TRANSPORT_VEHICLE_DIR, BACKEND, \Globals::NO_IMAGE);
//        $this->insurance = FHtml::getFileURL($this->insurance, TRANSPORT_VEHICLE_DIR, BACKEND, \Globals::NO_IMAGE);
//
        $image_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->image, 'd' => TRANSPORT_VEHICLE_DIR]);

        $permit_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->permit, 'd' => TRANSPORT_VEHICLE_DIR]);

        $insurance_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->insurance, 'd' => TRANSPORT_VEHICLE_DIR]);


        $this->image = $image_link;
        $this->permit = $permit_link;
        $this->insurance = $insurance_link;

        return $fields;
    }

//    public function afterFind()
//    {
//        $this->image = FHtml::getFileURL($this->image, TRANSPORT_VEHICLE_DIR, BACKEND, \Globals::NO_IMAGE);
//        $this->permit = FHtml::getFileURL($this->permit, TRANSPORT_VEHICLE_DIR, BACKEND, \Globals::NO_IMAGE);
//        $this->insurance = FHtml::getFileURL($this->insurance, TRANSPORT_VEHICLE_DIR, BACKEND, \Globals::NO_IMAGE);
//    }


    public function rules()
    {
        return [];
    }
}
