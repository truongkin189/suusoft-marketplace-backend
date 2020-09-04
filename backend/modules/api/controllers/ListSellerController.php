<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class ListSellerController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        // get seller info
        return [
            'listseller' => [
                'class' => 'backend\modules\app\actions\ListSellerAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
            
            'list_seller_radius' => [
                'class' => 'backend\modules\app\actions\ListSellerRadiusAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
        ];
    }

}
