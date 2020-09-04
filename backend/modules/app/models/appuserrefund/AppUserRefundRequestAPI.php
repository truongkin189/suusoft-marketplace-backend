<?php

namespace backend\modules\app\models\appuserrefund;

class AppUserRefundRequestAPI extends AppUserRefundRequestBase
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
