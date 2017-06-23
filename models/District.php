<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $amphur_id
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amphur_id'], 'integer'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'amphur_id' => 'Amphur ID',
        ];
    }
	//new code here
}
