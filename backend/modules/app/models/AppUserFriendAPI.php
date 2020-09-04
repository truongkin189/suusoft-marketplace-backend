<?php

namespace backend\modules\app\models;

use Yii;
/**
 * @property AppUserAPI $friend
 */



class AppUserFriendAPI extends AppUserFriendBase
{
    public $avatar;
    public $name;
    public $email;
    public $qb_id;
    public $phone;

    public function fields()
    {
        $fields = parent::fields();

        $friend_avatar_link = '';
        $name = '';
        $email = '';
        $qb_id = '';
        $phone = '';

        if(isset($this->friend)){

            if (filter_var($this->friend->avatar, FILTER_VALIDATE_URL)) {
                $friend_avatar_link =  $this->friend->avatar;
            }else{
                $friend_avatar_link = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f'=> $this->friend->avatar, 'd' => APP_USER_DIR, 's'=>'thumb']);
            }
            if(isset($this->friend->pro)){
                $name =  $this->friend->pro->business_name;
                $email = $this->friend->pro->business_email;
                $phone = $this->friend->pro->business_phone;
            }else{
                $name = $this->friend->name;
                $email = $this->friend->email;
                $phone = $this->friend->phone;
            }

            $qb_id = $this->friend->qb_id;
        }

        $this->avatar = $friend_avatar_link;
        $this->name = $name;
        $this->email = $email;
        $this->qb_id = $qb_id;
        $this->phone = $phone;

        $fields = array_merge($fields, [
            'avatar',
            'name',
            'email',
            'qb_id',
            'phone'
        ]);

        return $fields;
    }

    public function rules()
    {
        return [];
    }

    public function getFriend()
    {
        return $this->hasOne(AppUserAPI::className(), ['id' => 'friend_id']);
    }
}
