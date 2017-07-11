<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "research_area_information".
 *
 * @property string $id
 * @property string $area_id
 * @property string $province_id
 * @property string $amphur_id
 * @property string $district_id
 * @property string $region_id
 * @property string $image_id
 * @property string $information
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class ResearchAreaInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'research_area_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id','amphur_id', 'district_id', 'region_id', 'image_id'], 'required'],
            [['province_id','area_id', 'amphur_id', 'district_id', 'region_id', 'image_id', 'created_by', 'updated_by'], 'integer'],
            [['information'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับพื้นที่',
            'area_id' => 'รหัสพื้นที่วิจัย',
            'province_id' => 'รหัสจังหวัด',
            'amphur_id' => 'รหัสอำเภอ',
            'district_id' => 'รหัสตำบล',
            'region_id' => 'รหัสภูมิภาค',
            'image_id' => 'รหัสภาพ',
            'information' => 'ข้อมูลทั่วไป',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
    // new code
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            if($this->isNewRecord)
            {
                $this->created_date = new \yii\db\Expression('NOW()');
            }
             $this->updated_date = new \yii\db\Expression('NOW()');
            return true;
        }
        return false;
    }

    

    public function getAddressProvince(){
        return $this->hasOne(AddressProvince::className(),['id'=>'province_id']); 
    }

    public function getAddressAmphur(){
        return $this->hasOne(AddressAmphur::className(),['id'=>'amphur_id']); 
    }
    public function getAddressDistrict(){
        return $this->hasOne(AddressDistrict::className(),['id'=>'district_id']); 
    }
    public function getAddressRegion(){
        return $this->hasOne(AddressRegion::className(),['id'=>'region_id']); 
    }

}
