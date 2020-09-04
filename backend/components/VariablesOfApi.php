<?php
/**
 * Created by PhpStorm.
 * User: Quyen_Bui
 * Date: 7/23/2016
 * Time: 8:57 PM
 */

namespace backend\components;


class VariablesOfApi
{
    public static function getVariableLimited() {
        return 10;
    }

    public static function getCurrentApplicationId() {
        return 'test';
    }

}