<?php

namespace backend\modules\app\models\imagereport;

class AppUserReportImageAPI extends AppUserReportImageBase
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
