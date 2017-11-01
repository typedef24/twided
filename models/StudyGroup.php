<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "StudyGroup".
 *
 * @property integer $studyGroupId
 * @property string $name
 * @property string $description
 * @property string $dateCreated
 */
class StudyGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'StudyGroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['dateCreated'], 'safe'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'studyGroupId' => 'Study Group ID',
            'name' => 'Name',
            'description' => 'Description',
            'dateCreated' => 'Date Created',
        ];
    }
}
