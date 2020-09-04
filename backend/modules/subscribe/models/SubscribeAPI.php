<?php

namespace backend\modules\subscribe\models;

class SubscribeAPI extends SubscribeBase
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
