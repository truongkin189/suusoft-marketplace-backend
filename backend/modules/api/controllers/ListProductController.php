<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class ListProductController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        
        return [
            // get seller info and his product
            'listproduct' => [
                'class' => 'backend\modules\product\actions\ListProductSellerIdAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
            
            'list_product_radius' => [
                'class' => 'backend\modules\product\actions\ListProductRadiusAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],

            'list_product_sub_cate' => [
                'class' => 'backend\modules\product\actions\ListProductSubCateAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
            // 5:24pm 15/8/19
            'list_product_buyer_bought' => [
                'class' => 'backend\modules\product\actions\ListProductBuyerBoughtAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],

            'list_product_seller_sold' => [
                'class' => 'backend\modules\product\actions\ListProductSellerSoldAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
            // end add
            
            'list_product_hot' => [
                'class' => 'backend\modules\product\actions\ListProductHotAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],

            'list_product_new' => [
                'class' => 'backend\modules\product\actions\ListProductNewAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
            
            'list_product_premium' => [
                'class' => 'backend\modules\product\actions\ListProductPremiumAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
            'list-product-by-name' => [
                'class' => 'backend\modules\product\actions\ListProductByNameAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
        ];
    }

}
