<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;
use yii\helpers\ArrayHelper;

/**
 * Developed by Hung Ho (Steve): hung.hoxuan@gmail.com | skype: hung.hoxuan | whatsapp: +84912738748
 * Software Outsourcing, Mobile Apps development, Website development: Make meaningful products for start-ups and entrepreneurs
 * MOZA TECH Inc: www.moza-tech.com | www.apptemplate.co | www.projectemplate.com | www.code-faster.com
 * This is the customized model class for table "app_user_transaction_request".
 *
 * @property AppUserAPI $destination
 * @property AppUserAPI $user
 */
class AppUserTransactionRequest extends AppUserTransactionRequestBase //\yii\db\ActiveRecord
{
    const LOOKUP = [        'type' => [['id' => AppUserTransactionRequest::TYPE_REDEEM, 'name' => 'redeem'], ['id' => AppUserTransactionRequest::TYPE_TRANSFER, 'name' => 'transfer'], ],
        'status' => [['id' => AppUserTransactionRequest::STATUS_PENDING, 'name' => 'pending'], ['id' => AppUserTransactionRequest::STATUS_APPROVED, 'name' => 'approved'], ['id' => AppUserTransactionRequest::STATUS_REJECTED, 'name' => 'rejected'], ],
];

    const COLUMNS_UPLOAD = [];

    public $order_by = 'created_date desc,';

    const OBJECTS_RELATED = [];
    const OBJECTS_META = [];
    const COLUMNS = [
        'api' => ['id', 'user_id', 'destination_id', 'amount', 'type', 'note', 'status', 'time', 'created_date', 'modified_date', ],
        'all' => ['id', 'user_id', 'destination_id', 'amount', 'type', 'note', 'status', 'time', 'created_date', 'modified_date',  'objectAttributes', 'objectFile', 'objectCategories'],
        '+' => [  'objectAttributes', 'objectFile', 'objectCategories']
    ];

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
        
            [['id', 'user_id', 'destination_id', 'amount', 'type', 'note', 'status', 'time', 'created_date', 'modified_date'], 'filter', 'filter' => 'trim'],
            [['user_id', 'amount', 'type'], 'required'],
            [['user_id', 'destination_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['note'], 'string'],
            [['created_date', 'modified_date'], 'safe'],
            [['type'], 'string', 'max' => 255],
            [['time'], 'string', 'max' => 20],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
                    'id' => FHtml::t('AppUserTransactionRequest', 'ID'),
                    'user_id' => FHtml::t('AppUserTransactionRequest', 'User ID'),
                    'destination_id' => FHtml::t('AppUserTransactionRequest', 'Destination ID'),
                    'amount' => FHtml::t('AppUserTransactionRequest', 'Amount'),
                    'type' => FHtml::t('AppUserTransactionRequest', 'Type'),
                    'note' => FHtml::t('AppUserTransactionRequest', 'Note'),
                    'status' => FHtml::t('AppUserTransactionRequest', 'Status'),
                    'time' => FHtml::t('AppUserTransactionRequest', 'Time'),
                    'created_date' => FHtml::t('AppUserTransactionRequest', 'Created Date'),
                    'modified_date' => FHtml::t('AppUserTransactionRequest', 'Modified Date'),
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
        $i18n->translations['AppUserTransactionRequest*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@backend/messages',
            'fileMap' => [
                'AppUserTransactionRequest' => 'AppUserTransactionRequest.php',
            ],
        ];
    }

    public static function getLabel($key)
    {
        $str = array(
            'exchange' => 'Exchange' ,
            'redeem' => 'Redeem',
            'transfer' =>'Transfer',
            1 => 'Approved',
            0 => 'Pending',
            -1 => 'Rejected',
        );
        return isset($str[$key]) ? $str[$key] : 'n/a';
    }

    public function getDestination()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'destination_id']);
    }
    public function getUser()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'user_id']);
    }

}
