<?php
namespace backend\actions;

use common\components\Response;
use backend\models\ObjectCategoryAPI;

class CategoryAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized())!== true)
            return $re;
        //$user_id = $this->user_id;

        $categories = ObjectCategoryAPI::find()->all();
        $data = array();
        foreach ($categories as $item) {
            $data[] = $item;
        }

        return Response::getOutputForAPI($data, \Globals::SUCCESS, 'OK', ['code'=> 200]);

    }


}

