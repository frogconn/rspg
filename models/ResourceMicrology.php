<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use \yii\web\UploadedFile;
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

    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            'fileBehavior' => [
                'class' => \app\components\UploadBehavior::className()
            ],
        ];
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
            'zone_name' => 'ชื่อพื้นที่วิจัย',
            'type_name' => 'ประเภทจุลินทรีย์',
            'created_by' => 'สร้างโดย',
            'created_date' => 'สร้างเมื่อ',
            'updated_by' => 'แก้ไขล่าสุดโดย',
            'updated_date' => 'แก้ไขล่าสุดเมื่อ',
        ];
    }

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
    // new code here
	public function upload($model,$attribute)
	{
		$evidence_file  = UploadedFile::getInstance($model, $attribute);
		$path = $this->getUploadPath();
		if ($this->validate() && $evidence_file !== null) 
		{
			$fileName = md5($evidence_file->baseName.time()) . '.' . $evidence_file->extension;
			//$fileName = $photo->baseName . '.' . $photo->extension;
			if($evidence_file->saveAs($path.$fileName))
			{
				return $fileName;
			}
		}
		return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
	}

	public function getUploadPath()
	{
		return Yii::getAlias('@webroot').'/'.$this->upload_foler.'/';
	}

	public function getUploadUrl()
	{
		return Yii::getAlias('@web').'/'.$this->upload_foler.'/';
	}

	public function getPhotoViewer()
	{
		return empty($this->evidence_file) ? Yii::getAlias('@web').'/img/none.png' : $this->getUploadUrl().$this->evidence_file;
	}

    public function getResourceType (){
        return $this->hasOne (ResourceType::className(),['id'=>'type_id']);
    }

    public function getResearchArea (){
        return $this->hasOne (ResearchArea::className(),['id'=>'zone_id']);
    }
}
