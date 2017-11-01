<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * EditProfileForm is the model behind the Edit Profile Form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class EditProfileForm extends Model
{
    public $userName;
    public $email;
    public $country;
    public $phoneNumber;
    public $profilePic;
    public $secreteQtn;
    public $secreteAns;
    public $userUrl;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['userName', 'email', 'country', 'userUrl'], 'required'],
            [['userName', 'email', 'userUrl'], 'string', 'max' => 100],
            [['secreteAns'], 'string', 'max' => 20],
            [['phoneNumber'], 'string', 'max' => 15],
            [['country', 'secreteQtn'], 'integer'],
            [['userName', 'email', 'phone'], 'trim'],
            ['email', 'email'], // email has to be a valid email address
            ['profilePic', 'image', 'extensions' => 'png, jpg, jpeg, pjpeg, x-png',
             'maxSize' => 10000 * 1024 * 1024]
        ];
    }

    public function attributeLabels()
    {
        return [
            'userName' => 'Name',
            'email' => 'Email',
            'country' => 'Country',
            'phoneNumber' => 'Phone number',
            'secreteAns' => 'Secrete answer',
            'secreteQtn' => 'Secrete question',
            'profilePic' => 'Profile picture',
            'userUrl' => 'Profile url',
        ];
    }

}
