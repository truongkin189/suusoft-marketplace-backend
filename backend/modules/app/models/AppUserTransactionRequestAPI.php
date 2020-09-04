<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "app_user_transaction_request".
 */
class AppUserTransactionRequestAPI extends AppUserTransactionRequestBase
{
    public function fields()
    {
        $fields = parent::fields();

        return $fields;
    }

    public function rules()
    {
        return [];
    }
}
