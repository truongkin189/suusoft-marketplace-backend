<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class ListOrderController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        
        return [
            'list_order_buyer' => [
                'class' => 'backend\modules\product\actions\ListOrderBuyerAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
            'list_order_seller' => [
                'class' => 'backend\modules\product\actions\ListOrderSellerAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
        ];
    }

}
