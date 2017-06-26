<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "research_zone".
 *
 * @property integer $zone_id
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
            [['zone_id'], 'required'],
            [['zone_id', 'p_id', 'a_id', 'd_id', 'geo_id', 'img_id', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
            [['gen_info'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zone_id' => 'Zone ID',
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
            'zone_name' => 'ชื่อพื้นที่วิจัย',
            'p_name' => 'ชื่อจังหวัด', // Add from Province table
            'a_name' => 'ชื่ออำเภอ', // Add from Amphur table
            'd_name' => 'ชื่อตำบล', // Add from District table
        ];
    }

    public function getZone(){
        return $this->hasOne(Zone::className(),['zone_id'=>'zone_id']); // province.id => researchZone.p_id
    }

    public function getZone_name(){ // get attribute: getP_name is function named
        return $this->zone['zone_name'];
    }

    public function getProvince(){
        return $this->hasOne(Province::className(),['id'=>'p_id']); // province.id => researchZone.p_id
    }

    public function getP_name(){ // get attribute: getP_name is function named
        return $this->province['p_name'];
    }

    public function getAmphur(){
        return $this->hasOne(Amphur::className(),['id'=>'a_id']); 
    }

    public function getA_name(){
        return $this->amphur['a_name'];
    } 

    public function getDistrict(){
        return $this->hasOne(District::className(),['id'=>'d_id']); 
    }

    public function getD_name(){ 
        return $this->district['d_name'];
    }
}
