<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * PasswordResetForm is the model behind the Password Reset Form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class PasswordResetForm extends Model
{
    public $email;
    public $secreteQtn;
    public $secreteAns;
    public $newPass;
    public $confirmNewPass;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // login and password are both required
            [['confirmNewPass', 'newPass', 'email', 'secreteAns', 'secreteQtn'], 'required'],
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
            'secreteQtn' => 'Secrete question',
            'secreteAns' => 'Secrete Answer',
        ];
    }

}
