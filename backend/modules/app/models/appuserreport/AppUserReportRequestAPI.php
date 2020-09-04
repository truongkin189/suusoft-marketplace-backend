<?php

namespace backend\modules\app\models\appuserreport;

class AppUserReportRequestAPI extends AppUserReportRequestBase
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
