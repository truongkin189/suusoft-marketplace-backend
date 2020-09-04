<?php

namespace backend\modules\app\models\invitecode;

class AppUserInviteCodeAPI extends AppUserInviteCodeBase
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
