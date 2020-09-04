<?php

namespace backend\modules\product\models;

class ProductDealImageAPI extends ProductDealImageBase
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
