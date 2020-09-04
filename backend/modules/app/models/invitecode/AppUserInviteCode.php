<?php

namespace backend\modules\app\models\invitecode;

class AppUserInviteCode extends AppUserInviteCodeBase
{
    public $invite_bonus_point;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        
            [['user_id', 'invite_code'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['invite_bonus_point'], 'number'],
            [['created_at'], 'safe'],
            [['invite_code'], 'string', 'max' => 20],                
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User referred',
            'invite_code' => 'Invite Code',
            'created_at' => 'Created At',
            'status' => 'Status',
            'invite_bonus_point' => 'Invite bonus point'
        ];
    }
}
