<?php

namespace backend\modules\subscribe\models;

class Subscribe extends SubscribeBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['subscriber_id', 'subscribed_id'], 'required'],
            [['subscriber_id', 'subscribed_id'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subscriber_id' => 'Subscriber ID',
            'subscribed_id' => 'Subscribed ID',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
