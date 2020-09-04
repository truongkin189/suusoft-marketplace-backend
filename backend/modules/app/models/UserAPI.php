<?php

namespace backend\modules\app\models;

class UserAPI extends UserBase
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
