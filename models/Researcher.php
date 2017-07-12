<?php

namespace app\models;

use Yii;

use yii\behaviors\BlameableBehavior;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "researcher".
 *
 * @property string $id
 * @property string $personal_code
 * @property string $is_foreigner
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
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class Researcher extends \yii\db\ActiveRecord
{
    public $upload_foler ='uploads\evidence_file';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'researcher';
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
            [['personal_code', 'is_foreigner', 'title', 'firstname_th', 'lastname_th', 'firstname_en', 'lastname_en', 'gender', 'email', 'telephone'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['personal_code', 'title', 'telephone'], 'string', 'max' => 63],
            [['is_foreigner', 'gender'], 'string', 'max' => 1],
            [['firstname_th', 'lastname_th', 'firstname_en', 'lastname_en', 'email'], 'string', 'max' => 127],
            [['fullname_th', 'fullname_en'], 'string', 'max' => 255],
            [['evidence_file'], 'file',
			'skipOnEmpty' => true,
			'extensions' => 'png,jpg'
			]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'personal_code' => 'หมายเลขบัตรประชาชน/หมายเลขหนังสือเดินทาง',
            'is_foreigner' => 'ชาวต่างชาติ',
            'title' => 'คำนำหน้าชื่อ',
            'firstname_th' => 'ชื่อ',
            'lastname_th' => 'นามสกุล',
            'firstname_en' => 'Firstname',
            'lastname_en' => 'Lastname',
            'fullname_th' => 'ชื่อ-นามสกุล',
            'fullname_en' => 'Fullname',
            'gender' => 'เพศ',
            'email' => 'อีเมล',
            'telephone' => 'เบอร์โทรศัพท์',
            'evidence_file' => 'ไฟล์หลักฐาน',
            'created_by' => 'สร้างโดย',
            'created_date' => 'สร้างเมื่อ',
            'updated_by' => 'แก้ไขล่าสุดโดย',
            'updated_date' => 'แก้ไขล่าสุดเมื่อ',
            'isForeigner' => 'ชาวต่างชาติ',
             'gGender' => 'เพศ',
            'searchAll' => 'ค้นหา'
        ];
    }
    
    public function beforeSave($insert)
    {
        $this->fullname_th = $this->firstname_th." ".$this->lastname_th;
        $this->fullname_en = $this->firstname_en." ".$this->lastname_en;
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

    public function getIsForeigner() {
        return $this->is_foreigner === 'Y' ? 'ใช่' : 'ไม่ใช่';
    }
	
	public function getGGender() {
        return $this->gender === 'M' ? 'ชาย' : 'หญิง';
    }
}