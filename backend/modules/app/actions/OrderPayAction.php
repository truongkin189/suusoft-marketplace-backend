<?php
namespace backend\modules\app\actions;

use backend\actions\BaseAction;

use backend\modules\app\models\AppUserDeviceAPI;
use backend\modules\app\models\AppUserTokenAPI;
use common\components\Response;
use Yii;

class OrderPayAction extends BaseAction
{
    public function run()
    {	
        $amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '500';
        $merchant_name = isset($_REQUEST['name']) ? $_REQUEST['name'] : 'namek';
        $reference_id = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '212211122000';
        $order_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 'ORDIS_1234';
        $Username = isset($_REQUEST['name']) ? $_REQUEST['name'] : 'SHERWIN122';
        $Password = isset($_REQUEST['password']) ? $_REQUEST['password'] : 'SHERWIN1223';
        $AccountId = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : '1234567';
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'B6280F633A862E98D95155A9C903F73A3B8C917DAE300E5E8E02C02F9FBDBD3A';
    $secret_iv = '00000000000000000000000000000000';
    $key = hash('sha256', $secret_key);
    
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
//sample plaintext
    $plain_txt = '{"amount":'.$amount.'
    ,"merchant_name":"'.$merchant_name.'"
    ,"reference_id":"'.$reference_id.'",
    "order_id": "'.$order_id.'",
    "Username": "'.$Username.'",
    "Password": "'.$Password.'", 
    "AccountId": "'.$AccountId.'",
    "callback_url":"http://localhost/suusoft/marketplace/backend/web/index.php/api/deal/merchant_callback_url.php?payment_response="}';
    //
      $url2 = Yii::$app->urlManager->createAbsoluteUrl(['api/utility/pushNotification',
                        
                    ]);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // comment when test
                    curl_setopt($ch, CURLOPT_URL, $url2);
                    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Skip receive return
                    curl_exec($ch);
                    if ($ch === FALSE) {
                    echo "Lỗi cCURL";
                        } 
                        else {
                            //Thành công, kết quả trong $ch
                             echo "đay la ch thanh cong :".$ch."hêt";
                             }
                
                   
                    echo "đay la ch:".$ch."hêt";
                     curl_close($ch);
    // $data = array('amount' => $amount, "new" => $merchant_name, 'feature' => $reference_id);

    echo "Plain Text =" .$plain_txt. "<br><br>";

    $encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
    echo "Encrypted Text = " .$encrypted_txt;
    
    }

}