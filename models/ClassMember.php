<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ClassMember".
 *
 * @property integer $userId
 * @property integer $classroomId
 * @property string $status
 *
 * @property User $user
 */
class ClassMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ClassMember';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'classroomId'], 'required'],
            [['userId', 'classroomId'], 'integer'],
            [['status'], 'string'],
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
            'classroomId' => 'Classroom ID',
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
