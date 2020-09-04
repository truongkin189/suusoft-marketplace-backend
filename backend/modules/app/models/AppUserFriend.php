<?php

namespace backend\modules\app\models;

class AppUserFriend extends AppUserFriendBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'friend_id'], 'required'],
            [['user_id', 'friend_id'], 'integer'],
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
            'friend_id' => 'Friend ID',
        ];
    }
}
