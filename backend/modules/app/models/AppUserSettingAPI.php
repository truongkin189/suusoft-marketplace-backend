<?php

namespace backend\modules\app\models;

class AppUserSettingAPI extends AppUserSettingBase
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
