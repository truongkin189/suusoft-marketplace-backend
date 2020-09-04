<?php

namespace backend\modules\coupon\models;

class CouponAPI extends CouponBase
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
