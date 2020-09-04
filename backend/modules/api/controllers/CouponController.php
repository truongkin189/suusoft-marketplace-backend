<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class CouponController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        return [
            'check' => [
                'class' => 'backend\modules\coupon\actions\CheckAction',
                'checkAccess' => [$this, 'checkAccess']
            ],
            'request' => [
                'class' => 'backend\modules\app\actions\HelpAction',
                'checkAccess' => [$this, 'checkAccess']
            ],
        ];
    }
}