<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "research_zone".
 *
 * @property string $id
 * @property integer $zone_id
 * @property string $zone_name
 * @property integer $province_id
 * @property integer $amphur_id
 * @property integer $district_id
 * @property integer $region_id
 * @property integer $img_id
 * @property string $information
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class ResearchZone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'research_zone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone_id', 'province_id', 'amphur_id', 'district_id', 'region_id', 'img_id', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
            [['zone_name'], 'string', 'max' => 64],
            [['information'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zone_id' => 'Zone ID',
            'zone_name' => 'ชื่อพื้นที่',
            'province_id' => 'รหัสจังหวัด',
            'amphur_id' => 'รหัสอำเภอ',
            'district_id' => 'รหัสตำบล',
            'region_id' => 'รหัสภูมิภาค',
            'img_id' => 'รหัสภาพ',
            'information' => 'รายละเอียดข้อมูลทั่วไป',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
