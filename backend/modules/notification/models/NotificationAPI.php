<?php

namespace backend\modules\notification\models;

class NotificationAPI extends NotificationBase
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
