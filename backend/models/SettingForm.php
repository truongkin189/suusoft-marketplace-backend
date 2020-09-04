<?php
namespace backend\models;

use yii\base\Model;
use Yii;

class SettingForm extends Model
{
    public $admin_email;
    public $api_key;
    public $pem;
    public $company_name;
    public $company_description;
    public $company_homepage;
    public $exchange_rate;
    public $deal_online_rate;
    public $premium_deal_online_rate;
    public $driver_online_rate;
    public $searching_deal_distance;
    public $searching_driver_distance;
    public $exchange_fee;
    public $redeem_fee;
    public $transfer_fee;
    public $deal_payment_fee;
    public $trip_payment_fee;
    public $page_faq;
    public $page_about;
    public $page_help;
    public $page_term;
    public $key_push;

    // 2:29 16/8
    public $searching_product_distance;
    public $invite_bonus_point;
    
    // 4:26 22/8/19
    public $commission_rate;
    
    public $banner_file_1;
    public $banner_file_2;
    public $banner_file_3;
    public $banner_file_4;

    public $image_banner_1;
    public $image_banner_2;
    public $image_banner_3;
    public $image_banner_4;

    /**
     * @return array validation rules for model attributes.
     */

    public function rules()
    {
        return [
            [['admin_email'], 'string', 'max' => 300],
            [['page_faq', 'page_about', 'page_help', 'page_term'], 'string'],
            [
                [
                    'searching_deal_distance', 
                    'searching_driver_distance',
                    'searching_product_distance',
                    'invite_bonus_point',
                    'commission_rate'
                ], 
                'integer'
            ],
            [
                [
                'exchange_fee',
                'redeem_fee',
                'transfer_fee',
                'deal_payment_fee',
                'trip_payment_fee',
                ],
                'double'],
            [['exchange_rate', 'deal_online_rate', 'premium_deal_online_rate', 'driver_online_rate'], 'double'],
            [['api_key','key_push'], 'string', 'max' => 300],
            ['pem', 'file', 'extensions' => ['pem'], 'skipOnEmpty' => true, 'minSize' => 1],
            [['image_banner_1','image_banner_2','image_banner_3','image_banner_4'],'string', 'max' => 255],
            [['banner_file_1','banner_file_2','banner_file_3','banner_file_4'],'file','extensions' => ['jpg','png','jpeg'],'skipOnEmpty' => true]
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'admin_email' => 'Admin Email',
            'api_key' => 'Google API Key',
            'key_push' => 'Key Push Notification',
            'pem' => 'Pem File',
            'exchange_rate' => 'Exchange Rate',
            'deal_online_rate' => 'Deal Online Rate',
            'premium_deal_online_rate' => 'Premium Deal Online Rate',
            'driver_online_rate' => 'Driver Online Rate',
            'searching_deal_distance' => 'Searching Deal Distance',
            'searching_driver_distance' => 'Searching Driver Distance',
            'exchange_fee' => 'Exchange Fee',
            'redeem_fee' => 'Redeem Fee',
            'transfer_fee' => 'Transfer Fee',
            'deal_payment_fee' => 'Deal Payment Fee',
            'trip_payment_fee' => 'Trip Payment Fee',
            'page_faq' => 'Page FAQ',
            'page_about' => 'Page About',
            'page_help' => 'Page Help',
            'invite_bonus_point' => 'Invite bonus point',
            'searching_product_distance' => 'Searching Product Distance (km)',
            'commission_rate' => 'Commission Rate',
            'image_banner_1' => 'Banner 1',
            'image_banner_2' => 'Banner 2',
            'image_banner_3' => 'Banner 3',
            'image_banner_4' => 'Banner 4',
         
        );
    }

    /**
     * Create instance form $id of model
     */

    public function loadModel()
    {
        $model = new Setting();
        $this->admin_email = $model->getSettingValueByKey(\Globals::ADMIN_EMAIL);
        $this->api_key = $model->getSettingValueByKey(\Globals::GOOGLE_API_KEY);
        $this->pem = $model->getSettingValueByKey(\Globals::PEM_FILE);
        $this->exchange_rate = $model->getSettingValueByKey(\Globals::EXCHANGE_RATE);
        $this->deal_online_rate = $model->getSettingValueByKey(\Globals::DEAL_ONLINE_RATE);
        $this->premium_deal_online_rate = $model->getSettingValueByKey(\Globals::PREMIUM_DEAL_ONLINE_RATE);
        $this->driver_online_rate = $model->getSettingValueByKey(\Globals::DRIVER_ONLINE_RATE);
        $this->searching_deal_distance = $model->getSettingValueByKey(\Globals::SEARCHING_DEAL_DISTANCE);
        $this->searching_driver_distance = $model->getSettingValueByKey(\Globals::SEARCHING_DRIVER_DISTANCE);
        $this->exchange_fee = $model->getSettingValueByKey(\Globals::EXCHANGE_FEE);
        $this->redeem_fee = $model->getSettingValueByKey(\Globals::REDEEM_FEE);
        $this->transfer_fee = $model->getSettingValueByKey(\Globals::TRANSFER_FEE);
        $this->deal_payment_fee = $model->getSettingValueByKey(\Globals::DEAL_PAYMENT_FEE);
        $this->trip_payment_fee = $model->getSettingValueByKey(\Globals::TRIP_PAYMENT_FEE);
        $this->page_faq = $model->getSettingValueByKey(\Globals::PAGE_FAQ);
        $this->page_about = $model->getSettingValueByKey(\Globals::PAGE_ABOUT);
        $this->page_help = $model->getSettingValueByKey(\Globals::PAGE_HELP);
        $this->page_term = $model->getSettingValueByKey(\Globals::PAGE_TERM);
        $this->key_push = $model->getSettingValueByKey('key_push');
        
        $this->invite_bonus_point = $model->getSettingValueByKey(\Globals::INVITE_BONUS_POINT);
        $this->searching_product_distance = $model->getSettingValueByKey(\Globals::SEARCHING_PRODUCT_DISTANCE);
        
        $this->commission_rate = $model->getSettingValueByKey(\Globals::COMMISSION_RATE);
        
        $this->image_banner_1 = $model->getSettingValueByKey('IMAGE_BANNER_1', $this->image_banner_1);
        $this->image_banner_2 = $model->getSettingValueByKey('IMAGE_BANNER_2', $this->image_banner_2);
        $this->image_banner_3 = $model->getSettingValueByKey('IMAGE_BANNER_3', $this->image_banner_3);
        $this->image_banner_4 = $model->getSettingValueByKey('IMAGE_BANNER_4', $this->image_banner_4);

    }


    public function save()
    {

        $isSave = FALSE;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Setting();
            
            $model->setSettingValueByKey(\Globals::INVITE_BONUS_POINT, $this->invite_bonus_point);
            $model->setSettingValueByKey(\Globals::SEARCHING_PRODUCT_DISTANCE, $this->searching_product_distance);
            
            $model->setSettingValueByKey(\Globals::COMMISSION_RATE, $this->commission_rate);
            
            $model->setSettingValueByKey(\Globals::ADMIN_EMAIL, $this->admin_email);
            $model->setSettingValueByKey(\Globals::GOOGLE_API_KEY, $this->api_key);
            $model->setSettingValueByKey(\Globals::PEM_FILE, $this->pem);
            $model->setSettingValueByKey(\Globals::EXCHANGE_RATE, $this->exchange_rate);
            $model->setSettingValueByKey(\Globals::DEAL_ONLINE_RATE, $this->deal_online_rate);
            $model->setSettingValueByKey(\Globals::PREMIUM_DEAL_ONLINE_RATE, $this->premium_deal_online_rate);
            $model->setSettingValueByKey(\Globals::DRIVER_ONLINE_RATE, $this->driver_online_rate);
            $model->setSettingValueByKey(\Globals::SEARCHING_DEAL_DISTANCE, $this->searching_deal_distance);
            $model->setSettingValueByKey(\Globals::SEARCHING_DRIVER_DISTANCE, $this->searching_driver_distance);
            $model->setSettingValueByKey(\Globals::EXCHANGE_FEE, $this->exchange_fee);
            $model->setSettingValueByKey(\Globals::REDEEM_FEE, $this->redeem_fee);
            $model->setSettingValueByKey(\Globals::TRANSFER_FEE, $this->transfer_fee);
            $model->setSettingValueByKey(\Globals::DEAL_PAYMENT_FEE, $this->deal_payment_fee);
            $model->setSettingValueByKey(\Globals::TRIP_PAYMENT_FEE, $this->trip_payment_fee);
            $model->setSettingValueByKey(\Globals::PAGE_FAQ, $this->page_faq);
            $model->setSettingValueByKey(\Globals::PAGE_ABOUT, $this->page_about);
            $model->setSettingValueByKey(\Globals::PAGE_HELP, $this->page_help);
            $model->setSettingValueByKey(\Globals::PAGE_TERM, $this->page_term); 
            $model->setSettingValueByKey('key_push', $this->key_push);
            
            $model->setSettingValueByKey('IMAGE_BANNER_1', $this->image_banner_1);
            $model->setSettingValueByKey('IMAGE_BANNER_2', $this->image_banner_2);
            $model->setSettingValueByKey('IMAGE_BANNER_3', $this->image_banner_3);
            $model->setSettingValueByKey('IMAGE_BANNER_4', $this->image_banner_4);
            
            $transaction->commit();
            $isSave = true;

        } catch (\Exception $e) {
            $transaction->rollback();
        }

        if (!$isSave) {
            return false;
        }
        return true;
    }
}