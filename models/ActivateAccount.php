<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ActivateAccount".
 *
 * @property integer $userId
 * @property string $activateUrl
 * @property integer $status
 *
 * @property User $user
 */
class ActivateAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ActivateAccount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'activateUrl', 'status'], 'required'],
            [['userId', 'status'], 'integer'],
            [['activateUrl'], 'string', 'max' => 200],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'activateUrl' => 'Activate Url',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }
}
