<?php

namespace backend\modules\app\models;

class AppUserSetting extends AppUserSettingBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['user_id', 'notify', 'notify_favourite', 'notify_transport', 'notify_food', 'notify_labor', 'notify_travel', 'notify_shopping', 'notify_news', 'notify_nearby'], 'required'],
            [['user_id', 'notify', 'notify_favourite', 'notify_transport', 'notify_food', 'notify_labor', 'notify_travel', 'notify_shopping', 'notify_news', 'notify_nearby'], 'integer'],
            [['user_id'], 'unique'],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'notify' => 'Notify',
            'notify_favourite' => 'Notify Favourite',
            'notify_transport' => 'Notify Transport',
            'notify_food' => 'Notify Food',
            'notify_labor' => 'Notify Labor',
            'notify_travel' => 'Notify Travel',
            'notify_shopping' => 'Notify Shopping',
            'notify_news' => 'Notify News',
            'notify_nearby' => 'Notify Nearby',
        ];
    }
}
