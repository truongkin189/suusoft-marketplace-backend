<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class EcommerceController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        return [

            'banner-list'       => ['class' => 'backend\modules\ecommerce\actions\BannerListAction',      'checkAccess' => [$this, 'checkAccess']],
            'product-list'       => ['class' => 'backend\modules\product\actions\ProductListAction',      'checkAccess' => [$this, 'checkAccess']],
            'home-list'       => ['class' => 'backend\modules\product\actions\HomeListAction',      'checkAccess' => [$this, 'checkAccess']], 
            'order'       => ['class' => 'backend\modules\product\actions\OrderAction',      'checkAccess' => [$this, 'checkAccess']],
            'order-history'       => ['class' => 'backend\modules\product\actions\OrderHistoryAction',      'checkAccess' => [$this, 'checkAccess']], 
            'order-history-detail'       => ['class' => 'backend\modules\product\actions\OrderHistoryDetailAction',      'checkAccess' => [$this, 'checkAccess']],
            'order-update'       => ['class' => 'backend\modules\product\actions\OrderUpdateAction',      'checkAccess' => [$this, 'checkAccess']],
            'delivery-list'       => ['class' => 'backend\modules\product\actions\DeliveryListAction',      'checkAccess' => [$this, 'checkAccess']],
            'request-payment'       => ['class' => 'backend\modules\product\actions\RequestPaymentAction',      'checkAccess' => [$this, 'checkAccess']],
            'check-order-payment'       => ['class' => 'backend\modules\product\actions\CheckOrderPaymentAction',      'checkAccess' => [$this, 'checkAccess']],
            'check-order-payment'       => ['class' => 'backend\modules\product\actions\CheckOrderPaymentAction',      'checkAccess' => [$this, 'checkAccess']],
            'product-filter'       => ['class' => 'backend\modules\product\actions\ProductListFilterAction',      'checkAccess' => [$this, 'checkAccess']],
            'order-payment'       => ['class' => 'backend\modules\product\actions\OrderPaymentAction',      'checkAccess' => [$this, 'checkAccess']],
        ];
    }
}