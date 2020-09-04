<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $metaKey
 * @property string $metaValue
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['metaKey', 'metaValue'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'metaKey' => 'Meta Key',
            'metaValue' => 'Meta Value',
        ];
    }

    public static function getSettingValueByKey($key)
    {
        $data = Setting::find()->where("metaKey ='".$key."'")->one();
        return isset($data)? $data->metaValue : '';
    }

    public static function setSettingValueByKey($key,$value)
    {
        \Yii::$app->db->createCommand()->update('setting', ['metaValue' => $value], 'metaKey = "'.$key.'"' )->execute();
    }

}
