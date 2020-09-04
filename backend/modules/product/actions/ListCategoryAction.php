<?php
namespace backend\modules\product\actions;

use backend\actions\BaseAction;
use backend\modules\object\models\ObjectCategoryAPI;
use common\components\FHtml;
use common\components\Response;
use backend\models\Setting;
use Yii;

class ListCategoryAction extends BaseAction
{
    public $is_secured = true;

    public function run()
    {
        // if (($re = $this->isAuthorized()) !== true)
        //     return $re;
        // $user_id = $this->user_id;

        // code moi
        $categories = ObjectCategoryAPI::find()
        // ->select('id')
        ->where(['parent_id' => null])->all();
        
        $banner_list = array();
        
        for($i = 1; $i <= 4; $i++)
        {
            array_push($banner_list,['banner_image' => Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> Setting::getSettingValueByKey('IMAGE_BANNER_'.$i), 'd' => 'banner'])]);
        }

        return Response::getOutputForAPI($categories, \Globals::SUCCESS, 'OK', ['list_banner' => $banner_list,'code'=> 200]);


        // code cu
        // $category_and_sub = ObjectCategoryAPI::find()->all();

        // return Response::getOutputForAPI($category_and_sub, \Globals::SUCCESS, 'OK', ['code'=> 200]);

    }
}

