<?php
namespace frontend\models;

use yii\base\Model;
use Yii;

class ChangePasswordForm extends Model
{
    public $token;
    public $email;
    public $newPassword;
    public $newPasswordRepeat;

    /**
     * @return array validation rules for model attributes.
     */

    public function rules()
    {
        return [
            [['email', 'token', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['token', 'string', 'min' => 5, 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'min' => 5, 'max' => 255],
            [['newPassword' , 'newPasswordRepeat'], 'safe'],
            [
                'newPasswordRepeat', 'compare',
                'compareAttribute' => 'newPassword',
            ],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'token' => 'Token',
            'newPassword' => 'New password',
            'newPasswordRepeat' => 'Repeat Password',
        );
    }
}