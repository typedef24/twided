<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ContactMessage".
 *
 * @property integer $ContactMessageId
 * @property integer $parentId
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property string $dateCreated
 */
class ContactMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ContactMessage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentId'], 'integer'],
            [['name', 'body'], 'required'],
            [['body'], 'string'],
            [['dateCreated'], 'safe'],
            [['name', 'email', 'subject'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ContactMessageId' => 'Contact Message ID',
            'parentId' => 'Parent ID',
            'name' => 'Name',
            'email' => 'Email',
            'subject' => 'Subject',
            'body' => 'Body',
            'dateCreated' => 'Date Created',
        ];
    }
}
