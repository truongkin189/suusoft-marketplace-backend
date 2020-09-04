<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class OrderController extends ApiController
{
    /**
     * Update order deliviery
     * 
     */

    public function actions()
    {
        return [
            'delivery' => [
                'class' => 'backend\modules\app\actions\OrderAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
        ];
    }

}
