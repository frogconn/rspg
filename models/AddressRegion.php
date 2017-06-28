<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address_region".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 */
class AddressRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 1],
            [['name'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับ',
            'code' => 'รหัสภูมิภาค',
            'name' => 'ชื่อภูมิภาค',
        ];
    }
}
