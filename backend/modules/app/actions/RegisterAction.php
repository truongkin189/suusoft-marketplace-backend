<?php
namespace backend\modules\app\actions;
use backend\actions\BaseAction;
use backend\modules\app\models\AppUserAPI;
use common\components\Response;

use backend\modules\app\models\AppUserProBase;
use backend\modules\app\models\invitecode\AppUserInviteCode;

class RegisterAction extends BaseAction
{
    public $is_secured = false;

    public function run()
    {
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
        $invite_code = isset($_REQUEST['invite_code']) ? $_REQUEST['invite_code'] : '';
        
        $shop_name = isset($_REQUEST['shop_name']) ? $_REQUEST['shop_name'] : ''; //business name

        if (strlen($username) == 0
            || strlen($phone) == 0
            || strlen($name) == 0
            || strlen($password) == 0
        ) {
            return Response::getOutputForAPI('', \Globals::ERROR, \Globals::MISSING_PARAMS, ['code'=> 202]);
        }

        $check = AppUserAPI::find()->where("username = '". $username ."' OR phone = '" . $phone ."'")->one();

        if(isset($check))
        {
            return Response::getOutputForAPI('', \Globals::ERROR, Response::getErrorMsg(225), ['code'=> 225]);
        }
        else
        {
            $today = date('Y-m-d H:i:s',time());

            $new_user = new AppUserAPI();
            $new_user->name = $name;
            $new_user->email = $username;
            $new_user->username = $username;
            $new_user->gender = $gender;
            $new_user->address = $address;
            $new_user->phone = $phone;
            $new_user->is_active = \Globals::STATE_ACTIVE;
            $new_user->status = \Globals::LABEL_NORMAL;
            $new_user->created_date = $today;
            $new_user->balance = 0;
            $new_user->rate = 0;
            $new_user->rate_count = 0;

            $reset_token = md5(time());
            $new_user->password_reset_token = $reset_token;
            $new_user->setPassword($password);
            $new_user->generateAuthKey();

            if($new_user->save())
            {
                // added 2:22pm 16/8/19
                $invite = new AppUserInviteCode();
                $invite->user_id = $new_user->id;
                $invite->invite_code = $invite_code;
                $invite->status = 0;
                $invite->save();
                // end
                
                //26/8
                if(isset($shop_name))
                {
                    $seller = new AppUserProBase();
                    $seller->user_id = $new_user->id;
                    $seller->business_name = $shop_name;
                    $seller->is_active = 1;
                    $seller->save();
                }
                
                // send activation mail
                $send = \Yii::$app->mailer->compose(['html' => 'welcome-html', 'text' => 'welcome-text', 'htmlLayout'=>'@layouts/welcome-html.php'], ['user' => $new_user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
                    ->setTo($new_user->email)
                    ->setSubject('[iwanadeal] Welcome new member')
                    ->send();
                if($send){
                    return Response::getOutputForAPI('', \Globals::SUCCESS, 'OK', ['code'=> 200]);
                }else{
                    $new_user->delete();
                    return Response::getOutputForAPI('', \Globals::ERROR, 'Can not send activation email, please check your email address', ['code'=> 229]);
                }
                
                return Response::getOutputForAPI('', \Globals::SUCCESS, 'OK', ['code'=> 200]);
            }
            else
            {
                $errors = $new_user->getErrors();
                $error_message = Response::getErrorMessage($errors);
                return Response::getOutputForAPI('', \Globals::ERROR, $error_message, ['code'=> 203]);
            }
        }
    }
}
