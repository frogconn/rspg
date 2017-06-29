<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource_micrology".
 *
 * @property string $id
 * @property string $genus
 * @property string $species
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
class ResourceMicrology extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource_micrology';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['genus', 'species', 'zone_id', 'type_id'], 'required'],
            [['information', 'benefit'], 'string'],
            [['zone_id', 'image_id', 'type_id', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['genus', 'species'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับข้อมูลจุลินทรีย์',
            'genus' => 'ชื่อ Genus',
            'species' => 'ชื่อสายพันธุ์',
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

    public function getName (){
        return $this->resourceType['name'];
    }

    public function getResearchArea (){
        return $this->hasOne (ResearchArea::className(),['id'=>'zone_id']);
    }

    public function getAreaName (){
        return $this->researchArea['name'];
    }
}
