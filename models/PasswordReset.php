<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PasswordReset".
 *
 * @property integer $idPasswordReset
 * @property integer $userId
 * @property string $resetUrl
 * @property integer $isExpired
 */
class PasswordReset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PasswordReset';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'resetUrl'], 'required'],
            [['userId', 'isExpired'], 'integer'],
            [['resetUrl'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPasswordReset' => 'Id Password Reset',
            'userId' => 'User ID',
            'resetUrl' => 'Reset Url',
            'isExpired' => 'Is Expired',
        ];
    }
}
