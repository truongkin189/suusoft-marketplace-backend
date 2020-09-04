<?php

namespace backend\modules\transport\models;

use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

class TransportDriverAPI extends TransportDriverBase
{
    public function fields()
    {
        $fields = parent::fields();
        //$this->driver_license =  FHtml::getFileURL($this->driver_license, TRANSPORT_DRIVER_DIR, BACKEND, \Globals::NO_IMAGE);


        $driver_license_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->driver_license, 'd' => TRANSPORT_DRIVER_DIR]);
        $this->driver_license = $driver_license_link;

        return $fields;
    }


    public function rules()
    {
        return [];
    }
}
