<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 * SignupForm is the model behind the SignUp form.
 */
class SignupForm extends Model
{
    public $userName;
    public $email;
    public $userType;
    public $password;
    public $confirmpassword;
    public $verifyCode;

    public function rules()
    {
        return [
            // all fields are required
            [['userName', 'email', 'userType', 'password', 'confirmpassword', 'verifyCode'], 'required'],
            [['userName', 'email', 'password', 'confirmpassword'], 'trim'],
            ['email', 'email'], // email has to be a valid email address
            [['userName', 'email'] , 'string', 'max' => 100],   
            //confirming password compare
            ['confirmpassword','compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match!" ],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }
    
    
    public function attributeLabels()
    {
        return [
            'userName' => 'Your name',
            'email' => 'Your email',
            'password' => 'Password',
            'confirmpassword' => 'Confirm password',
            'userType' => 'Signup option',
            'verifyCode' => 'Verification code',
        ];
    }

}
