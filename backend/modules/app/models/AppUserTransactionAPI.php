<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "app_user_transaction".
 *
 *
 * @property AppUserAPI $destination
 * @property AppUserAPI $user
 *
 */
class AppUserTransactionAPI extends AppUserTransactionBase
{
    public $destination_email;
    public $user_email;

    public function fields()
    {
        $fields = parent::fields();
        if(isset($this->destination)){
            $this->destination_email = $this->destination->email;
        }
        if(isset($this->user)){
            $this->user_email = $this->user->email;
        }
        $fields = array_merge($fields, [
            'destination_email',
            'user_email'
        ]);

        return $fields;

    }

    public function rules()
    {
        return [];
    }

    public function getDestination()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'destination_id']);
    }
    public function getUser()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'user_id']);
    }
}
