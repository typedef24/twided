<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ChangePasswordForm is the model behind the change password form.
 */
class ChangePasswordForm extends Model
{
    public $newPassword;
    public $confirmNewPassword;
    public $currentPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // all fields are required
            [['newPassword', 'confirmNewPassword', 'currentPassword'], 'required'],
            //confirming password compare
            ['confirmNewPassword','compare', 'compareAttribute'=>'newPassword', 'message'=>"Passwords don't match!" ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'newPassword' => 'New password',
            'confirmNewPassword' => 'Confirm new password',
            'currentPassword' => 'Current password',
        ];
    }

}
