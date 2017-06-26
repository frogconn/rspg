<?php

namespace app\models;

use Yii;

use yii\web\UploadedFile;

/**
 * This is the model class for table "researcher".
 *
 * @property string $foreigner
 * @property string $pers_id
 * @property string $title
 * @property string $firstname_th
 * @property string $lastname_th
 * @property string $firstname_en
 * @property string $lastname_en
 * @property string $fullname_th
 * @property string $fullname_en
 * @property string $gender
 * @property string $email
 * @property string $telephone
 * @property string $evidence_file
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class Researcher extends \yii\db\ActiveRecord
{
	public $upload_foler ='uploads'; //location folder maybe .../web/uploads
    /**
     * @inheritdoc
     */
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
            [['pers_id'], 'required'],
            [['update_date', 'created_date'], 'safe'],
            [['created_by', 'update_by'], 'integer'],
            [['foreigner'], 'string', 'max' => 3],
            [['pers_id', 'telephone'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 32],
            [['firstname_th', 'lastname_th', 'firstname_en', 'lastname_en', 'email'], 'string', 'max' => 128],
            [['fullname_th', 'fullname_en'], 'string', 'max' => 255],
			[['evidence_file'],'file',
			'skipOnEmpty' => true,
			'extensions' => 'png,jpg'],
            [['gender'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'foreigner' => 'ชาวต่างชาติ',
            'pers_id' => 'หมายเลขบัตรประชาชน/หมายเลขหนังสือเดินทาง',
            'title' => 'คำนำหน้าชื่อ',
            'firstname_th' => 'ชื่อ(ไทย)',
            'lastname_th' => 'นามสกุล(ไทย)',
            'firstname_en' => 'ชื่อ(อังกฤษ)',
            'lastname_en' => 'นามสกุล(อังกฤษ)',
            'fullname_th' => 'ชื่อเต็ม(ไทย)',
            'fullname_en' => 'ชื่อเต็ม(อังกฤษ)',
            'gender' => 'เพศ',
            'email' => 'อีเมล',
            'telephone' => 'เบอร์โทรศัพท์',
            'evidence_file' => 'ไฟล์หลักฐาน',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }

    public function getFullnameTh()
    {
        return $this->firstname_th. " " .$this->lastname_th;
    }

    public function getFullnameEn()
    {
        return $this->firstname_en. " " .$this->lastname_en;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidences()
    {
        return $this->hasMany(Evidence::className(), ['researcher_id' => 'id']);
    }
	
	//upload method
	//this code can create model
    public function upload($model,$attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
          $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {
            $fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
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
	//upload method
}
