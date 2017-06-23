<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "research_zone".
 *
 * @property string $id
 * @property integer $zone_id
 * @property string $zone_name
 * @property integer $p_id
 * @property integer $a_id
 * @property integer $d_id
 * @property integer $geo_id
 * @property integer $img_id
 * @property string $gen_info
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
            [['zone_id', 'p_id', 'a_id', 'd_id', 'geo_id', 'img_id', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
            [['zone_name'], 'string', 'max' => 64],
            [['gen_info'], 'string', 'max' => 256],
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
            'p_id' => 'รหัสจังหวัด',
            'a_id' => 'รหัสอำเภอ',
            'd_id' => 'รหัสตำบล',
            'geo_id' => 'รหัสภูมิภาค',
            'img_id' => 'รหัสภาพ',
            'gen_info' => 'รายละเอียดข้อมูลทั่วไป',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
