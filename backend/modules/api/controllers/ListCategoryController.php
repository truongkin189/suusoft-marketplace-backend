<?php

namespace backend\modules\api\controllers;

use backend\controllers\ApiController;

/**
 * Default controller for the `api` module
 */
class ListCategoryController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actions()
    {
        // get seller info and his product
        return [
            'listcategory' => [
                'class' => 'backend\modules\product\actions\ListCategoryAction', 
                'checkAccess' => [$this, 'checkAccess']
            ],
        ];
    }

}
