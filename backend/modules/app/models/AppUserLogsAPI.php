<?php

namespace backend\modules\app\models;

class AppUserLogsAPI extends AppUserLogsBase
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
