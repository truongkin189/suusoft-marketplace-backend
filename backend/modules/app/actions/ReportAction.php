<?php
namespace backend\modules\app\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\appuserreport\AppUserReportRequestAPI;
use backend\modules\app\models\imagereport\AppUserReportImageAPI;
use common\components\FHtml;
use common\components\Response;
use Yii;

/* @var $check AppUserAPI*/

class ReportAction extends BaseAction
{
    // public $is_secured = true;

    public function run()
    {
        // if (($re = $this->isAuthorized())!== true)
        //     return $re;

        $seller_id = FHtml::getRequestParam('seller_id', '');
        $buyer_id = FHtml::getRequestParam('buyer_id', '');
        $order_id = FHtml::getRequestParam('order_id', '');
        $product_id = FHtml::getRequestParam('product_id', '');
        $note = FHtml::getRequestParam('note', '');
        $image_file_1 = isset($_FILES['image']) ? $_FILES['image'] : null;

        // $user_id = $this->user_id;

        if(strlen($seller_id) == 0 || strlen($buyer_id) == 0 || strlen($order_id) == 0
            || strlen($product_id) == 0)
        {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }
        else
        {
            $file_path = \Yii::getAlias('@' . UPLOAD_DIR) . '/' . REPORT_IMAGE_DIR . '/';
            
            $model = new AppUserReportRequestAPI();
            
            $now = time();
            $time_string = time();

            $model->buyer_id = $buyer_id;
            $model->seller_id = $seller_id;
            $model->order_id = $order_id;
            $model->product_id = $product_id;
            $model->note = $note;
            $model->created_at = date('Y-m-d H:i:s',$time_string);
            
            if($model->save())
            {   
                // xu ly anh
                $ext1 = pathinfo($image_file_1['name'], PATHINFO_EXTENSION);

                $image_1_name = $now . '_report_image.' . $ext1;

                $report_image = new AppUserReportImageAPI();
                $report_image->report_id = $model->id;
                $report_image->image = $image_1_name;
                $report_image->save();
        
                $image_1_path = $file_path . $image_1_name;

                $upload = move_uploaded_file($image_file_1['tmp_name'], $image_1_path);

                // end xu ly
               
               
                return Response::getOutputForAPI('', \Globals::SUCCESS, 'OK', ['code'=> 200]);
            }
            else
            {
                return Response::getOutputForAPI('', \Globals::ERROR, 'Something went wrong', ['code'=> 200]);
            }
        }

        
        
    }

}
