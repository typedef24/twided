<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * PasswordResetLinkForm is the model behind the Password Reset Link Form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class PasswordResetLinkForm extends Model
{
    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],

        ];
    }

    /**
     * @return array the attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Your email',
        ];
    }

}
