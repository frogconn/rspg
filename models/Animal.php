<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property integer $animal_id
 * @property string $com_name
 * @property string $loc_name
 * @property string $sc_name
 * @property string $fam_name
 * @property string $gen_info
 * @property integer $zone_id
 * @property string $banefit
 * @property integer $img_code
 * @property integer $type_id
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class Animal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['animal_id'], 'required'],
            [['animal_id', 'zone_id', 'img_code', 'type_id', 'created_by', 'update_by'], 'integer'],
            [['gen_info', 'banefit'], 'string'],
            [['update_date', 'created_date'], 'safe'],
            [['com_name', 'loc_name', 'sc_name', 'fam_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => 'รหัสสัตว์',
            'com_name' => 'ชื่อสามัญ',
            'loc_name' => 'ชื่อท้องถิ่น',
            'sc_name' => 'ชื่อวิทยาศาสตร์',
            'fam_name' => 'ชื่อวงศ์',
            'gen_info' => 'ข้อมูลทั่วไป',
            'zone_id' => 'รหัสพื้นที่',
            'banefit' => 'กรใช้ประโยชน์',
            'img_code' => 'รหัสภาพ',
            'type_id' => 'รหัสประเภท',
            'type_name' => 'ประเภท',
            'zone_name' => 'ชื่อพื้นที่วิจัย',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ]; 
    }

    public function getZone(){
        return $this->hasOne(Zone::className(),['zone_id'=>'zone_id']); // province.id => researchZone.p_id
    }

    public function getZone_name(){ // get attribute: getP_name is function named
        return $this->zone['zone_name'];
    }

    public function getType(){
        return $this->hasOne(Type::className(),['type_id'=>'type_id']); // province.id => researchZone.p_id
    }

    public function getType_name(){ // get attribute: getP_name is function named
        return $this->type['type_name'];
    }
}
