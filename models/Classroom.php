<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Classroom".
 *
 * @property integer $classroomId
 * @property string $name
 * @property string $description
 * @property string $dateCreated
 */
class Classroom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Classroom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
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
            'classroomId' => 'Classroom ID',
            'name' => 'Name',
            'description' => 'Description',
            'dateCreated' => 'Date Created',
        ];
    }
}
