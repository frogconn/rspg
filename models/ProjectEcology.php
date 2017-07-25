<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use \yii\web\UploadedFile;
/**
 * This is the model class for table "project_ecology".
 *
 * @property integer $id
 * @property string $year
 * @property string $name
 * @property string $personal_code
 * @property integer $faculty_id
 * @property double $budget
 * @property string $summary
 * @property integer $type_id
 * @property string $created_by
 * @property string $created_date
 * @property string $updated_by
 * @property string $updated_date
 */
class ProjectEcology extends \yii\db\ActiveRecord
{
    public $schedule = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_ecology';
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
            [['created_date', 'update_date', 'start', 'stop'], 'safe'],
            [['year', 'faculty_id', 'type_id'], 'integer'],
            [['budget'], 'number'],
            [['summary'], 'string'],
            [['name', 'created_by', 'updated_by'], 'string', 'max' => 255],
            [['personal_code'], 'string', 'max' => 64   ],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'ปีงบประมาณ',
            'name' => 'ชื่อโครงการวิจัย',
            'personal_code' => 'หัวหน้าโครงการวิจัย',
            'faculty_id' => 'คณะ', //รหัสคณะของหัวหน้าวิจัย
            'budget' => 'งบประมาณ',
            'type_id' => 'รหัสประเภทของโครงการ',
            'summary' => 'สรุปผลงานวิจัย',
            'type_id' => 'รหัสด้าน',
            'created_by' => 'สร้างโดย',
            'created_date' => 'สร้างเมื่อ',
            'updated_by' => 'แก้ไขล่าสุดโดย',
            'updated_date' => 'แก้ไขล่าสุดเมื่อ',
            'schedule' => 'ผู้เข้าร่วมโครงการ',
            'start' => 'วันเริ่มต้นโครงการ',
            'stop' => 'วันสิ้นสุดโครงการ'

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

    public function getResearcher ()
    {
        return $this->hasOne (Researcher::className(),['personal_code'=>'personal_code']);
    }

    public function getPartitions()
    {
        return $this->hasMany(ProjectPartitions::className(), ['project_id' => 'id']);
    }

    public function getProjectType(){
        return $this->hasOne(ProjectType::className(),['id'=>'type_id']);
    }

    public function getResearcherFaculty(){
        return $this->hasOne(ResearcherFaculty::className(),['id'=>'faculty_id']);
    }
     public function getUser (){
        return $this->hasOne (User::className(), ['id'=>'updated_by']);
    }
}
