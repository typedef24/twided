<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Message".
 *
 * @property integer $messageId
 * @property integer $senderId
 * @property integer $recieverId
 * @property string $message
 * @property integer $isRead
 * @property string $dateCreated
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senderId', 'recieverId', 'message'], 'required'],
            [['senderId', 'recieverId', 'isRead'], 'integer'],
            [['message'], 'string'],
            [['dateCreated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'messageId' => 'Message ID',
            'senderId' => 'Sender ID',
            'recieverId' => 'Reciever ID',
            'message' => 'Message',
            'isRead' => 'Is Read',
            'dateCreated' => 'Date Created',
        ];
    }
}
