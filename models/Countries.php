<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Countries".
 *
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
        ];
    }
}
