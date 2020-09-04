<?php

namespace backend\modules\app\models;

use Yii;
use common\components\FHtml;

class AppUserTransaction extends AppUserTransactionBase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_id', 'user_id', 'amount', 'time', 'is_active'], 'required'],
            [['object_id', 'user_id', 'user_visible', 'destination_id', 'destination_visible'], 'integer'],
            [['amount'], 'number'],
            [['created_date', 'modified_date'], 'safe'],
            [['transaction_id', 'external_transaction_id', 'action'], 'string', 'max' => 255],
            [['object_type', 'currency', 'payment_method', 'type', 'is_active', 'created_user', 'modified_user', 'application_id'], 'string', 'max' => 100],
            [['note'], 'string', 'max' => 2000],
            [['time'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => FHtml::t('AppUserTransaction', 'ID'),
            'transaction_id' => FHtml::t('AppUserTransaction', 'Transaction ID'),
            'external_transaction_id' => FHtml::t('AppUserTransaction', 'External Transaction ID'),
            'user_id' => FHtml::t('AppUserTransaction', 'User ID'),
            'user_visible' => FHtml::t('AppUserTransaction', 'User Visible'),
            'destination_id' => FHtml::t('AppUserTransaction', 'Destination ID'),
            'destination_visible' => FHtml::t('AppUserTransaction', 'Destination Visible'),
            'object_id' => FHtml::t('AppUserTransaction', 'Object ID'),
            'object_type' => FHtml::t('AppUserTransaction', 'Object Type'),
            'amount' => FHtml::t('AppUserTransaction', 'Amount'),
            'currency' => FHtml::t('AppUserTransaction', 'Currency'),
            'payment_method' => FHtml::t('AppUserTransaction', 'Payment Method'),
            'note' => FHtml::t('AppUserTransaction', 'Note'),
            'time' => FHtml::t('AppUserTransaction', 'Time'),
            'action' => FHtml::t('AppUserTransaction', 'Action'),
            'type' => FHtml::t('AppUserTransaction', 'Type'),
            'is_active' => FHtml::t('AppUserTransaction', 'Is Active'),
            'created_date' => FHtml::t('AppUserTransaction', 'Created Date'),
            'created_user' => FHtml::t('AppUserTransaction', 'Created User'),
            'modified_date' => FHtml::t('AppUserTransaction', 'Modified Date'),
            'modified_user' => FHtml::t('AppUserTransaction', 'Modified User'),
            'application_id' => FHtml::t('AppUserTransaction', 'Application ID'),
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
        $i18n->translations['AppUserTransaction*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@backend/messages',
            'fileMap' => [
                'AppUserTransaction' => 'AppUserTransaction.php',
            ],
        ];
    }
}
