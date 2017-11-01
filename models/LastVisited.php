<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "LastVisited".
 *
 * @property integer $userId
 * @property string $type
 * @property integer $typeId
 *
 * @property User $user
 */
class LastVisited extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'LastVisited';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'type', 'typeId'], 'required'],
            [['userId', 'typeId'], 'integer'],
            [['type'], 'string'],
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
            'type' => 'Type',
            'typeId' => 'Type ID',
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
