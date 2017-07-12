<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address_amphur".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $province_id
 * @property string $region_id
 */
class AddressAmphur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_amphur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'province_id'], 'required'],
            [['province_id', 'region_id'], 'integer'],
            [['code'], 'string', 'max' => 5],
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
            'code' => 'รหัสอำเภอ',
            'name' => 'ชื่ออำเภอ',
            'province_id' => 'รหัสจังหวัด',
            'region_id' => 'รหัสภูมิภาค',
        ];
    }
}
