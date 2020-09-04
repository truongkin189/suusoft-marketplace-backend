<?php
/**
 * Created by PhpStorm.
 * User: Quyen_Bui
 * Date: 7/12/2016
 * Time: 3:10 PM
 */

namespace common\components;


use yii\base\Controller;

class Helper extends Controller
{
    // Display percentage
    public static function displayPercentage ($value) {
        if (isset($value)) {
            return $value. '%';
        } else
            return 0;
    }

    // Display price with currency
    public static function displayPrice ($value) {
       return number_format($value);
    }

    public static function checkHiddenField ($name, $array){

        foreach ($array as $item){
            if(strpos($item,'*') == 0){
                if(strpos($name,trim($item,'*')) !== false){
                    return true;
                }
            }else{
                if ($name == $item){
                    return true;
                }
            }
        }

        return false;
    }
}