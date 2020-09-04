<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "app_user".
 * @property AppUserProAPI $pro
 */
class AppUser extends AppUserBase //\yii\db\ActiveRecord
{
    public $avatar_file;
    public $money_admin_transfer;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'username', 'email', 'password'], 'required'],
            [['content'], 'string'],
            [['balance', 'rate','money_admin_transfer'], 'number'],
            [['point', 'is_online', 'is_active', 'role', 'rate_count', 'qb_id'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['avatar', 'name', 'username', 'email', 'password', 'password_hash', 'password_reset_token', 'dob', 'weight', 'height', 'address', 'card_number', 'card_cvv', 'card_exp', 'lat', 'long'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 2000],
            [['gender', 'country', 'state', 'city', 'type', 'status'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 25],
            [['avatar_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => FHtml::t('AppUser', 'ID'),
            'qb_id' => FHtml::t('AppUser', 'Qb ID'),
            'avatar' => FHtml::t('AppUser', 'Avatar'),
            'name' => FHtml::t('AppUser', 'Name'),
            'username' => FHtml::t('AppUser', 'Username'),
            'email' => FHtml::t('AppUser', 'Email'),
            'password' => FHtml::t('AppUser', 'Password'),
            'auth_key' => FHtml::t('AppUser', 'Auth Key'),
            'password_hash' => FHtml::t('AppUser', 'Password Hash'),
            'password_reset_token' => FHtml::t('AppUser', 'Password Reset Token'),
            'description' => FHtml::t('AppUser', 'Description'),
            'content' => FHtml::t('AppUser', 'Content'),
            'gender' => FHtml::t('AppUser', 'Gender'),
            'dob' => FHtml::t('AppUser', 'Dob'),
            'phone' => FHtml::t('AppUser', 'Phone'),
            'weight' => FHtml::t('AppUser', 'Weight'),
            'height' => FHtml::t('AppUser', 'Height'),
            'address' => FHtml::t('AppUser', 'Address'),
            'country' => FHtml::t('AppUser', 'Country'),
            'state' => FHtml::t('AppUser', 'State'),
            'city' => FHtml::t('AppUser', 'City'),
            'balance' => FHtml::t('AppUser', 'Balance'),
            'point' => FHtml::t('AppUser', 'Point'),
            'card_number' => FHtml::t('AppUser', 'Card Number'),
            'card_cvv' => FHtml::t('AppUser', 'Card Cvv'),
            'card_exp' => FHtml::t('AppUser', 'Card Exp'),
            'lat' => FHtml::t('AppUser', 'Lat'),
            'long' => FHtml::t('AppUser', 'Long'),
            'is_online' => FHtml::t('AppUser', 'Is Online'),
            'is_active' => FHtml::t('AppUser', 'Is Active'),
            'type' => FHtml::t('AppUser', 'Type'),
            'status' => FHtml::t('AppUser', 'Status'),
            'role' => FHtml::t('AppUser', 'Role'),
            'rate' => FHtml::t('AppUser', 'Rate'),
            'rate_count' => FHtml::t('AppUser', 'Rate Count'),
            'created_date' => FHtml::t('AppUser', 'Created Date'),
            'modified_date' => FHtml::t('AppUser', 'Modified Date'),
            'money_admin_transfer' => FHtml::t('AppUser', 'Money Admin Transfer'),
            'avatar_file' => 'Avatar File',
        ];
    }


    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['AppUser*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@backend/messages',
            'fileMap' => [
                'AppUser' => 'AppUser.php',
            ],
        ];
    }

    public function getPro()
    {
        return $this->hasOne(AppUserProAPI::className(), ['user_id' => 'id']);
    }

    public static function getLabel($key)
    {
        $str = array(
            1 => 'Yes',
            0 => 'No',
        );
        return isset($str[$key]) ? $str[$key] : 'n/a';
    }
}
