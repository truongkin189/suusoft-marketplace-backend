<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class RefundController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        return [
            'request' => ['class' => 'backend\modules\app\actions\RefundAction', 'checkAccess' => [$this, 'checkAccess']],
        ];
    }
}