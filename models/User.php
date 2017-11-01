<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property integer $userId
 * @property string $userName
 * @property string $email
 * @property string $phoneNumber
 * @property string $password
 * @property string $userType
 * @property integer $secreteQtn
 * @property string $secreteAns
 * @property string $userUrl
 * @property integer $country
 * @property string $lastAction
 * @property string $lastActionTime
 * @property string $lastRequestTime
 * @property string $signUpDate
 *
 * @property ActivateAccount $activateAccount
 * @property ClassMember[] $classMembers
 * @property LastVisited $lastVisited
 * @property PasswordReset[] $passwordResets
 * @property StudyGroupMember[] $studyGroupMembers
 */

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userName', 'email', 'password', 'userType', 'userUrl'], 'required'],
            [['userType'], 'string'],
            [['country', 'secreteQtn'], 'integer'],
            [['lastActionTime', 'lastRequestTime', 'signUpDate'], 'safe'],
            [['userName', 'email', 'userUrl', 'lastAction'], 'string', 'max' => 100],
            [['phoneNumber'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 60],
            [['secreteAns'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['userUrl'], 'unique'],
            [['phoneNumber'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'userName' => 'User Name',
            'email' => 'Email',
            'phoneNumber' => 'Phone Number',
            'password' => 'Password',
            'userType' => 'User Type',
            'secreteQtn' => 'Secrete Qtn',
            'secreteAns' => 'Secrete Ans',
            'userUrl' => 'User Url',
            'country' => 'Country',
            'lastAction' => 'Last Action',
            'lastActionTime' => 'Last Action Time',
            'lastRequestTime' => 'Last Request Time',
            'signUpDate' => 'Sign Up Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivateAccount()
    {
        return $this->hasOne(ActivateAccount::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassMembers()
    {
        return $this->hasMany(ClassMember::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastVisited()
    {
        return $this->hasOne(LastVisited::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasswordResets()
    {
        return $this->hasMany(PasswordReset::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudyGroupMembers()
    {
        return $this->hasMany(StudyGroupMember::className(), ['userId' => 'userId']);
    }

    public static function findIdentity($userId)
    {
        return static::findOne($userId);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->userId;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
