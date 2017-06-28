<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address_district".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $amphur_id
 * @property string $province_id
 * @property string $region_id
 */
class AddressDistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amphur_id', 'province_id', 'region_id'], 'integer'],
            [['code'], 'string', 'max' => 6],
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
            'code' => 'รหัสตำบล',
            'name' => 'ชื่อตำบล',
            'amphur_id' => 'รหัสอำเภอ',
            'province_id' => 'รหัสจังหวัด',
            'region_id' => 'รหัสภูมิภาค',
        ];
    }
}
