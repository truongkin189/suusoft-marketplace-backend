<?php

namespace backend\modules\app\models\helprequest;

class AppUserHelpRequestAPI extends AppUserHelpRequestBase
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
