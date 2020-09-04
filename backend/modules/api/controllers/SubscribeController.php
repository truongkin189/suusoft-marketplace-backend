<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class SubscribeController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        return [
            'subscribe' => [
                'class' => 'backend\modules\subscribe\actions\SubscribeAction',
                'checkAccess' => [$this, 'checkAccess']
            ],
            
            'check_subscribe' => [
                'class' => 'backend\modules\subscribe\actions\CheckSubscribeAction',
                'checkAccess' => [$this, 'checkAccess']
            ],
            
        ];
    }
}