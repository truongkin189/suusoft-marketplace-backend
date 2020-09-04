<?php

namespace backend\modules\product\models;

use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;
use backend\modules\product\models\ProductDealImage;

class ProductDeal extends ProductDealBase //\yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $image_file;
    public $attachment_file;
     
    public function rules()
    {
        return [
            [['name', 'seller_id'], 'required'],
            [['content'], 'string'],
            [['quantity', 'discount_rate', 'is_online', 'online_duration', 'is_premium', 'is_renew', 'is_active', 'seller_id', 'view_count', 'like_count', 'rate_count', 'reservation_count'], 'integer'],
            [['price', 'sale_price', 'discount', 'rate'], 'number'],
            [['rate'], 'number', 'max' => 10],
            [['discount_expired', 'created_date', 'modified_date'], 'safe'],
            [['image', 'attachment'], 'string', 'max' => 300],
            [['name', 'lat', 'long', 'address'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000],
            [['category_id'], 'string', 'max' => 500],
            [['discount_type', 'online_started'], 'string', 'max' => 20],
			[['status', 'country', 'state', 'city', 'created_user', 'modified_user', 'application_id'], 'string', 'max' => 100],                       
			[['image_file'], 'file','skipOnEmpty' => true, 'extensions'=>'jpg, gif, png'],                               
			[['attachment_file'], 'file','skipOnEmpty' => true, 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => FHtml::t('ProductDeal', 'ID'),
            'image_file' => FHtml::t('ProductDeal', 'Image'),
            'attachment_file' => FHtml::t('ProductDeal', 'Attachment'),
            'name' => FHtml::t('ProductDeal', 'Name'),
            'description' => FHtml::t('ProductDeal', 'Description'),
            'content' => FHtml::t('ProductDeal', 'Content'),
            'category_id' => FHtml::t('ProductDeal', 'Category ID'),
            'quantity' => FHtml::t('ProductDeal', 'Quantity'),
            'price' => FHtml::t('ProductDeal', 'Price'),
            'discount' => FHtml::t('ProductDeal', 'Discount'),
            'sale_price' => FHtml::t('ProductDeal', 'Sale Price'),
            'discount_rate' => FHtml::t('ProductDeal', 'Discount Rate'),
            'discount_expired' => FHtml::t('ProductDeal', 'Discount Expired'),
            'is_online' => FHtml::t('ProductDeal', 'Is Online'),
            'online_started' => FHtml::t('ProductDeal', 'Online Started'),
            'online_duration' => FHtml::t('ProductDeal', 'Online Duration'),
            'is_premium' => FHtml::t('ProductDeal', 'Is Premium'),
            'is_renew' => FHtml::t('ProductDeal', 'Is Renew'),
            'status' => FHtml::t('ProductDeal', 'Status'),
            'is_active' => FHtml::t('ProductDeal', 'Is Active'),
            'lat' => FHtml::t('ProductDeal', 'Lat'),
            'long' => FHtml::t('ProductDeal', 'Long'),
            'country' => FHtml::t('ProductDeal', 'Country'),
            'state' => FHtml::t('ProductDeal', 'State'),
            'city' => FHtml::t('ProductDeal', 'City'),
            'address' => FHtml::t('ProductDeal', 'Address'),
            'seller_id' => FHtml::t('ProductDeal', 'Seller ID'),
            'view_count' => FHtml::t('ProductDeal', 'View Count'),
            'like_count' => FHtml::t('ProductDeal', 'Like Count'),
            'rate' => FHtml::t('ProductDeal', 'Rate'),
            'rate_count' => FHtml::t('ProductDeal', 'Rate Count'),
            'reservation_count' => FHtml::t('ProductDeal', 'Reservation Count'),
            'created_date' => FHtml::t('ProductDeal', 'Created Date'),
            'created_user' => FHtml::t('ProductDeal', 'Created User'),
            'modified_date' => FHtml::t('ProductDeal', 'Modified Date'),
            'modified_user' => FHtml::t('ProductDeal', 'Modified User'),
            'application_id' => FHtml::t('ProductDeal', 'Application ID'),
        ];
    }


    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }
    
    public function getImages()
    {
        return $this->hasMany(ProductDealImage::className(), ['product_deal_id' => 'id']);
    }

    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['ProductDeal*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@backend/messages',
            'fileMap' => [
                'ProductDeal' => 'ProductDeal.php',
            ],
        ];
    }
}
