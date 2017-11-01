<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MailPasswordResetForm is the model behind the mail Password Reset Form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class MailPasswordResetForm extends Model
{
    public $newPass;
    public $confirmNewPass;
    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // all fields are required
            [['confirmNewPass', 'newPass', 'email'], 'required'],
            [['email'], 'email'],
            //confirming password compare
            ['confirmNewPass', 'compare', 'compareAttribute' => 'newPass', 'message' => "Passwords don't match!"],
        ];
    }

    /**
     * @return array the attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Your email',
            'newPass' => 'New password',
            'confirmNewPass' => 'Confirm new password',
        ];
    }

}
