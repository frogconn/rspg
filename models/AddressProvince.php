<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address_province".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $region_id
 */
class AddressProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id'], 'integer'],
            [['code'], 'string', 'max' => 2],
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
            'code' => 'รหัสจังหวัด',
            'name' => 'ชื่อจังหวัด',
            'region_id' => 'รหัสภูมิภาค',
        ];
    }
}
