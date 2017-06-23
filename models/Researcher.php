<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "researcher".
 *
 * @property string $id
 * @property integer $foreigner
 * @property string $pers_id
 * @property string $title
 * @property string $firstname_th
 * @property string $lastname_th
 * @property string $firstname_en
 * @property string $lastname_en
 * @property string $fullname_th
 * @property string $fullname_en
 * @property integer $gender
 * @property string $email
 * @property string $telephone
 * @property string $evidence_file
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 *
 * @property Evidence[] $evidences
 */
class Researcher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	public $upload_foler ='uploads\researcher_evidence';
	 
    public static function tableName()
    {
        return 'researcher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foreigner', 'gender', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
            [['pers_id', 'telephone'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 32],
            [['firstname_th', 'lastname_th', 'firstname_en', 'lastname_en', 'email'], 'string', 'max' => 128],
            [['fullname_th', 'fullname_en'], 'string', 'max' => 255],
			//[['evidence_file'],'required'],
			[['evidence_file'], 'file',
			'skipOnEmpty' => true,
			'extensions' => 'png,jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสนักวิจัย',
            'foreigner' => 'ชาวต่างชาติ(foreigner)',
            'pers_id' => 'หมายเลขบัตรประชาชน/หมายเลขหนังสือเดินทาง',
            'title' => 'คำนำหน้าชื่อ',
            'firstname_th' => 'ชื่อ(ไทย)',
            'lastname_th' => 'นามสกุล(ไทย)',
            'firstname_en' => 'Firstname(Eng)',
            'lastname_en' => 'Lastname(Eng)',
            'fullname_th' => 'ชื่อเต็ม(ไทย)',
            'fullname_en' => 'Fullname(Eng)',
            'gender' => 'เพศ',
            'email' => 'อีเมล',
            'telephone' => 'เบอร์โทรศัพท์',
            'evidence_file' => 'Evidence File',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }

    public function getFullnameTh(){
        return $this->firstname_th. " " .$this->lastname_th;
    }

    public function getFullnameEn(){
        return $this->firstname_en. " " .$this->lastname_en;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidences()
    {
        return $this->hasMany(Evidence::className(), ['researcher_id' => 'id']);
    }
	
	//
	public function upload($model,$attribute)
	{
		$evidence_file  = UploadedFile::getInstance($model, $attribute);
		$path = $this->getUploadPath();
		if ($this->validate() && $evidence_file !== null) 
		{
			$fileName = md5($evidence_file->baseName.time()) . '.' . $evidence_file->extension;
			//$fileName = $picture->baseName . '.' . $picture->extension;
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
    
}
