<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource_plant".
 *
 * @property string $id
 * @property string $common_name
 * @property string $location_name
 * @property string $science_name
 * @property string $family_name
 * @property string $information
 * @property string $zone_id
 * @property string $benefit
 * @property string $image_id
 * @property string $type_id
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class ResourcePlant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource_plant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['common_name', 'location_name', 'science_name', 'family_name', 'zone_id', 'type_id'], 'required'],
            [['information', 'benefit'], 'string'],
            [['zone_id', 'image_id', 'type_id', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['common_name', 'location_name', 'science_name', 'family_name'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับข้อมูลพืช',
            'common_name' => 'ชื่อสามัญ',
            'location_name' => 'ชื่อท้องถิ่น',
            'science_name' => 'ชื่อวิทยาศาสตร์',
            'family_name' => 'ชื่อวงศ์',
            'information' => 'ข้อมูลทั่วไป',
            'zone_id' => 'รหัสพื้นที่',
            'benefit' => 'ประโยชน์',
            'image_id' => 'รหัสรูปภาพ',
            'type_id' => 'รหัสประเภท',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    public function getResourceType (){
        return $this->hasOne (ResourceType::className(),['id'=>'type_id']);
    }

    public function getResearchArea (){
        return $this->hasOne (ResearchArea::className(),['id'=>'zone_id']);
    }
}
