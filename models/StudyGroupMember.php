<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "StudyGroupMember".
 *
 * @property integer $userId
 * @property integer $studyGroupId
 * @property string $status
 *
 * @property User $user
 */
class StudyGroupMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'StudyGroupMember';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'studyGroupId'], 'required'],
            [['userId', 'studyGroupId'], 'integer'],
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
            'studyGroupId' => 'Study Group ID',
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
