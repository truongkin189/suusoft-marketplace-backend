<?php
namespace backend\modules\app\actions;

use backend\actions\BaseAction;
use backend\modules\app\models\AppUserAPI;
use backend\modules\app\models\AppUserDeviceAPI;
use backend\modules\app\models\AppUserTokenAPI;
use backend\modules\app\models\AppUserSettingAPI;
use common\components\Response;
use \stdClass;

class LoginAction extends BaseAction
{
    public $is_secured = false;

    public function run()
    {
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
        $ime = isset($_REQUEST['ime']) ? $_REQUEST['ime'] : '';
        $gcm_id = isset($_REQUEST['gcm_id']) ? $_REQUEST['gcm_id'] : '';
        //$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '1';
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $login_type = isset($_REQUEST['login_type']) ? $_REQUEST['login_type'] : 'n';  //n normal/s social network
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $avatar = isset($_REQUEST['avatar']) ? $_REQUEST['avatar'] : '';

        if (
            (
                strlen($username) == 0
                || strlen($ime) == 0
                //|| strlen($status) == 0
                //|| strlen($gcm_id) == 0
                //|| strlen($type) == 0
            )
            || ($login_type == 'n' && strlen($password) == 0)
            || ($login_type == 's' && strlen($name) == 0)
        ) {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, \Globals::MISSING_PARAMS, ['code' => 202]);
        }

        /* @var \backend\modules\app\models\AppUserAPI $check */
        /* @var \backend\modules\app\models\AppUserAPI $checkEmail */

        $checkEmail = AppUserAPI::find()->where("username = '" . $username . "'")->one();
        $today = date('Y-m-d H:i:s', time());
        if ($login_type == 'n') { //normal
            if (!isset($checkEmail)) {
                return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, Response::getErrorMsg(223), ['code' => 223]);
            }
        } else { //social
            if (!$checkEmail) {
                $check = new AppUserAPI();
                $check->name = $name;
                $check->avatar = $avatar;
                $check->email = $username;
                $check->username = $username;
                $check->is_active = \Globals::STATE_ACTIVE;
                $check->status = \Globals::LABEL_NORMAL;
                $check->created_date = $today;
                $check->save();
            } else {
                $checkEmail->avatar = $avatar;
                $checkEmail->name = $name;
                $checkEmail->save();
            }
        }

        $check = AppUserAPI::findByUsername($username);

        if (isset($check)) {

            if ($login_type == 'n') {
                if (strlen($check->password) == 0) {
                    return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, Response::getErrorMsg(233), ['code' => 233]);
                }
                if (!$check->validatePassword($password)) {
                    return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, \Globals::WRONG_PASSWORD, ['code' => 222]);
                }
            }
            $user_id = $check->id;

            $token = md5($user_id . time());

            /* @var \backend\modules\app\models\AppUserDeviceAPI $checkDevice */
            /* @var \backend\modules\app\models\AppUserTokenAPI $loginToken */

            $loginToken = AppUserTokenAPI::find()->where('user_id = "' . $check->id . '"')->one();
            if (isset($loginToken)) {
                $loginToken->token = $token;
                $loginToken->time = $today;
                $loginToken->save();
            } else {
                $loginToken = new AppUserTokenAPI();
                $loginToken->user_id = $user_id;
                $loginToken->token = $token;
                $loginToken->time = $today;
                $loginToken->save();
            }

            $check->is_online = \Globals::STATE_ACTIVE;
            $check->save();

            $data = $check;

            return Response::getOutputForAPI($data, \Globals::SUCCESS, 'OK', ['login_token' => $loginToken->token, 'code' => 200]);
        } else {
            return Response::getOutputForAPI(new stdClass(), \Globals::ERROR, 'Your account is not activated', ['code' => 228]);
        }
    }
}
