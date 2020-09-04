<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class AvepayController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        return [
           
            'order' => ['class' => 'backend\modules\product\actions\OrderPayAction', 'checkAccess' => [$this, 'checkAccess']],
        ];
    }

}
