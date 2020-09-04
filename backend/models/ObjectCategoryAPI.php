<?php

namespace backend\models;

class ObjectCategoryAPI extends ObjectCategoryBase
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
