<?php
use backend\models\Setting;

// define('DS', DIRECTORY_SEPARATOR);
define('SITE', 'site');
defined('UPLOAD_DIR') or define('UPLOAD_DIR', 'upload');
define('WWW_DIR', 'www');
define('CATEGORY_DIR', 'object-category');
define('APP_USER_DIR', 'app-user');
define('TRANSPORT_DRIVER_DIR', 'transport-driver');
define('TRANSPORT_VEHICLE_DIR', 'transport-vehicle');
define('PRODUCT_DEAL_DIR', 'product-deal');
define('OBJECT_CATEGORY_DIR', 'object-category');
define('REPORT_IMAGE_DIR', 'report-image');


defined('FRONTEND') or define('FRONTEND', 'frontend');
defined('BACKEND') or define('BACKEND', 'backend');
defined('WEB_DIR') or define('WEB_DIR', 'web');
define('PEM_DIR', 'pem');


if (!isset($root_dir)) $root_dir = dirname(dirname(dirname(__FILE__)));
Yii::setAlias('@' . UPLOAD_DIR, $root_dir . DS . BACKEND . DS . WEB_DIR . DS . UPLOAD_DIR);
Yii::setAlias('@' . SITE, $root_dir);

class Globals
{
    const
        ADMIN_EMAIL = 'ADMIN_EMAIL',
        GOOGLE_API_KEY = 'GOOGLE_API_KEY',
        PEM_FILE = 'PEM_FILE',
        PRIVACY = 'PRIVACY',
        COMPANY_NAME = 'COMPANY_NAME',
        COMPANY_DESCRIPTION = 'COMPANY_DESCRIPTION',
        COMPANY_HOMEPAGE = 'COMPANY_HOMEPAGE',
        EXCHANGE_RATE = 'EXCHANGE_RATE',
        DEAL_ONLINE_RATE = 'DEAL_ONLINE_RATE',
        PREMIUM_DEAL_ONLINE_RATE = 'PREMIUM_DEAL_ONLINE_RATE',
        DRIVER_ONLINE_RATE = 'DRIVER_ONLINE_RATE',
        SEARCHING_DEAL_DISTANCE = 'SEARCHING_DEAL_DISTANCE',
        SEARCHING_DRIVER_DISTANCE = 'SEARCHING_DRIVER_DISTANCE',
        INVITE_BONUS_POINT = 'INVITE_BONUS_POINT',
        SEARCHING_PRODUCT_DISTANCE = 'SEARCHING_PRODUCT_DISTANCE',
        COMMISSION_RATE = 'COMMISSION_RATE',


        EXCHANGE_FEE = 'EXCHANGE_FEE',
        TRANSFER_FEE = 'TRANSFER_FEE',
        REDEEM_FEE = 'REDEEM_FEE',
        TRIP_PAYMENT_FEE = 'TRIP_PAYMENT_FEE',
        DEAL_PAYMENT_FEE = 'DEAL_PAYMENT_FEE',
        PAGE_FAQ = 'PAGE_FAQ',
        PAGE_ABOUT = 'PAGE_ABOUT',
        PAGE_HELP = 'PAGE_HELP',
        PAGE_TERM = 'PAGE_TERM',

        SUCCESS = 'SUCCESS',
        ERROR = 'ERROR',
        STATUS_ACTIVE = '1',
        STATUS_INACTIVE = '0',
        MISSING_PARAMS = 'Missing parameters',
        STATE_ACTIVE = 1,
        STATE_INACTIVE = 0,
        STATE_DELETED = -1;

    const
        TYPE_ANDROID = 1,
        TYPE_IOS = 2,
        NO_IMAGE = 'no_image.png';
    const
        DEFAULT_ITEMS_PER_PAGE = 10;
    const
        WIDGET_COLOR_DEFAULT = "darkblue",
        WIDGET_TYPE_DEFAULT = "light bordered",
        WIDGET_TYPE_BOX = "box",
        WIDGET_TYPE_NONE = "light", // light, light bordered, box
        WIDGET_TYPE_LIGHT = "light bordered";

    const
        LABEL_ACTIVE = 'active',
        LABEL_INACTIVE = 'inactive',
        LABEL_NEW = 'new',
        LABEL_NORMAL = 'normal',
        LABEL_PREMIUM = 'premium',
        LABEL_OLD = 'old';

    const
        UPLOAD_FAIL = 'Upload fail';
    const
        DEFAULT_AVATAR = 'default_avatar.jpg';
    const

        STATUS_PUBLISH = 'publish',
        STATUS_DRAFT = 'draft',
        DEVICE_TYPE_ANDROID = 1,
        DEVICE_TYPE_IOS = 2,

        PAYMENT_STATUS_PAID = 1,//'paid'
        PAYMENT_STATUS_PENDING = 0;//'pending'

    const
        STATUS_FAIL = 'fail',
        STATUS_APPROVED = 'approved',
        STATUS_REJECTED = 'rejected',
        STATUS_PROCESSING = 'processing',
        STATUS_FINISH = 'finish',
        STATUS_PENDING = 'pending';

    const
        ACTION_DETAIL = 'detail',
        ACTION_DELETE = 'delete',
        ACTION_FINISH = 'finish',
        ACTION_DENY = 'deny',
        ACTION_REJECT = 'reject',
        ACTION_CANCEL = 'cancel',
        ACTION_DEAL = 'deal',
        ACTION_PAY = 'pay',
        ACTION_CREATE = 'create',
        ACTION_UPDATE = 'update',
        ACTION_ORDER = 'order';

    const
        SEARCH_TYPE_MINE = 'mine',
        SEARCH_TYPE_NEARBY = 'nearby',
        SEARCH_TYPE_ALL = 'all',
        SEARCH_TYPE_FAVOURITE = 'favourite',
        SEARCH_TYPE_NO_DEAL = 'nodeal',
        SEARCH_TYPE_REVIEW = 'review',
        SEARCH_TYPE_BOUGHT = 'bought',
        SEARCH_TYPE_SOLD = 'sold';

    const
        ROLE_SELLER = 'seller',
        ROLE_BUYER = 'buyer',
        ROLE_PASSENGER = 'passenger',
        ROLE_DRIVER = 'driver';

    const
        OBJECT_TYPE_DEAL = 'deal',
        OBJECT_TYPE_TRIP = 'trip',
        OBJECT_TYPE_COUPON = 'coupon',
        OBJECT_TYPE_SELL = 'sell';

    const
        EMAIL_OR_USERNAME_EXIST = 'Email or username existed',
        EMAIL_EXIST = 'Email exist',
        EMAIL_DOES_NOT_EXIST = 'Email does not exist',
        EMAIL_OR_USERNAME_DOES_NOT_EXIST = 'Email or username does not exist',
        WRONG_PASSWORD = 'Wrong password',
        USER_NOT_FOUND = 'User not found',
        DEAL_NOT_FOUND = 'Deal not found',
        DATA_NOT_FOUND = 'Data not found',
        TOKEN_MISMATCH = 'Token mismatch',
        CAN_NOT_PERFORM = 'You can not perform this action';

    public static $imageExtension = array('jpg', 'png', 'gif');

    public static function getCategoryKeyword($id)
    {
        $keyword = '';
        switch ($id) {
            case 3:
                $keyword = 'food';
                break;
            case 4:
                $keyword = 'labor';
                break;
            case 5:
                $keyword = 'travel';
                break;
            case 6:
                $keyword = 'shopping';
                break;
            case 7:
                $keyword = 'news';
                break;
            case 8:
                $keyword = 'nearby';
                break;
        }
        return $keyword;
    } 

    public static function pushAndroid($a_devices, $msg, $type, $additional_data)
    {
         $api_key = Setting::getSettingValueByKey('key_push');
        // $api_key = 'AIzaSyC9vLpao9GqgDa9rJhRSF3vS3tA_8THCvE';


        //$url = 'https://android.googleapis.com/gcm/send';
        $url = 'https://fcm.googleapis.com/fcm/send';

        $loop = ceil(count($a_devices) / 1000);
        $msg = array
        (
            'message' => $msg,
            'notificationType' => $type, //system / deal / trip / balance
            'additionalData' => $additional_data
        );

        for ($i = 1; $i <= $loop; $i++) {
            if (0 < count($a_devices) && count($a_devices) < 1000)
                $registrationID = $a_devices;
            else {
                $registrationID = array_slice($a_devices, 0, 1000);
                $a_devices = array_slice($a_devices, 1000, count($a_devices));
            }

            $fields = array
            (
                'registration_ids' => $registrationID,
                'data' => $msg
            );

            $headers = array(
                'Authorization: key=' . $api_key,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_exec($ch);
             
             // also get the error and response code
            $errors = curl_error($ch);
            $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            curl_close($ch);
 
            
             
              
        }
    }

    public static function pushIosX($i_devices, $message)
    {
        //Working well if all device token is right
        //if 1st right / 2nd wrong : Push on first
        //if 1st wrong / 2nd right : No push on both
        //Push will terminated if have any error

        $badge = 1;
        $sound = 'default';
        $development = true;//make it false if it is not in development mode
        $passphrase = 'iwanadeal';//your passphrase

        $payload = array();
        $payload['aps'] = array(
            'alert' => $message,
            'badge' => intval($badge),
            'sound' => $sound
        );

        $payload = json_encode($payload);

        $apns_url = NULL;
        $apns_cert = NULL;
        $apns_port = 2195;

        $pem = Setting::getSettingValueByKey(Globals::PEM_FILE);

        if ($development) {
            $apns_url = 'gateway.sandbox.push.apple.com';
            $apns_cert = dirname(Yii::$app->request->scriptFile) . '/' . UPLOAD_DIR . '/' . PEM_DIR . '/' . $pem;
        } else {
            $apns_url = 'gateway.push.apple.com';
            $apns_cert = dirname(Yii::$app->request->scriptFile) . '/' . UPLOAD_DIR . '/' . PEM_DIR . '/' . $pem;
        }

        $stream_context = stream_context_create();
        stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
        stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

        $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
        foreach ($i_devices as $idevice) {
            $token = $idevice;
            $device_tokens = str_replace("<", "", $token);
            $device_tokens1 = str_replace(">", "", $device_tokens);
            $device_tokens2 = str_replace(' ', '', $device_tokens1);
            $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', $device_tokens2) . chr(0) . chr(strlen($payload)) . $payload;
            fwrite($apns, $apns_message);
        }
        //cause fatal errors
        //@socket_close($apns);
        @fclose($apns);

    }

    public static function pushIos($i_devices, $message, $type, $additional_data)
    {
        //working any case
        $badge = 1;
        $sound = 'default';
        $development = true;//make it false if it is not in development mode
        $passphrase = 'iwanadeal';

        $payload = array();
        $payload['aps'] = array(
            'alert' => $message,
            'badge' => intval($badge),
            'sound' => $sound
        );
        $payload['notificationType'] = $type;
        $payload['additionalData'] = $additional_data;

        $payload = json_encode($payload);

        $apns_url = NULL;
        $apns_cert = NULL;
        $apns_port = 2195;

        $pem = Setting::getSettingValueByKey(Globals::PEM_FILE);

        if (strlen($pem) > 0) {
            if ($development) {
                $apns_url = 'gateway.sandbox.push.apple.com';
                $apns_cert = dirname(Yii::$app->request->scriptFile) . '/' . UPLOAD_DIR . '/' . PEM_DIR . '/' . $pem;
            } else {
                $apns_url = 'gateway.push.apple.com';
                $apns_cert = dirname(Yii::$app->request->scriptFile) . '/' . UPLOAD_DIR . '/' . PEM_DIR . '/' . $pem;
            }
        }

        $stream_context = stream_context_create();
        stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
        stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

        try {
            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
        } catch (Exception $e) {
            var_dump($e);
            die('Can not connect to APNS');
        }

        $number = 0;

        foreach ($i_devices as $idevice) {
            $number += 1;
            $token = $idevice;
            $device_tokens = str_replace("<", "", $token);
            $device_tokens1 = str_replace(">", "", $device_tokens);
            $device_tokens2 = str_replace(' ', '', $device_tokens1);

            $expiry = time() + 30;

            $apns_message = chr(1) . pack("N", rand(1000, 9999)) . pack("N", $expiry) . pack("n", 32) . pack('H*', $device_tokens2) . pack("n", strlen($payload)) . $payload;
            $msgapns = fwrite($apns, $apns_message);

            usleep(2000);

            if (!$msgapns) {
                //@socket_close($apns);
                @fclose($apns);
            } else {
                $read = array($apns);
                $null = null;
                $changedStreams = stream_select($read, $null, $null, 0, 1000000);

                if ($changedStreams === false) {
                    //fail
                } elseif ($changedStreams > 0) {
                    $responseBinary = fread($apns, 6);
                    if ($responseBinary !== false || strlen($responseBinary) == 6) {
                        $response = unpack('Ccommand/Cstatus_code/Nidentifier', $responseBinary);
                        if ($response['status_code']) {
                            //echo $number . ' Fail!. ';
                            //fail
                            //@socket_close($apns);
                            @fclose($apns);
                            $stream_context = stream_context_create();
                            stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
                            stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
                            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
                            stream_set_blocking($apns, 0);
                        }
                    }
                } else {
                    //echo $number . ' Success!. ';
                }
            }
        }
        //cause fatal errors
        //@socket_close($apns);
        @fclose($apns);
    }

    public static function generateRegisterCode()
    {
        $s = strtoupper(md5(time() . rand(1, 100)));
        return $s;
    }

    public static function generateActivationCode($email)
    {
        $s = strtoupper(md5(uniqid(rand(), true)));
        $e = strtoupper(md5($email));
        return substr($s . $e, 5, strlen($s));
    }

    public static function getConfig($key, $default_value)
    {
        return \common\components\FHtml::config($key, $default_value);
    }

    public static function generateTransactionId($userId)
    {
        $s = strtoupper(md5(uniqid(rand(), true)));
        return substr($s . $userId, 18, strlen($s));
    }
}