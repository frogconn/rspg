<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $id
 * @property string $name
 * @property string $personal_code
 * @property string $department_id
 * @property integer $year
 * @property integer $budget
 * @property string $start
 * @property string $stop
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class Project extends \yii\db\ActiveRecord
{
    public $schedule;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    public function init()
    {
        parent::init();

        $this->schedule = [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'personal_code', 'department_id', 'year', 'budget', 'start', 'stop'], 'required'],
            [['department_id', 'year', 'budget', 'created_by', 'updated_by'], 'integer'],
            [['summary'], 'string'],
            [['start', 'stop', 'created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 127],
            [['personal_code'], 'string', 'max' => 63],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับโครงการ',
            'name' => 'ชื่อโครงการ',
            'personal_code' => 'ชื่อหัวหน้าโครงการ', // Save in personal_code form
            'department_id' => 'ลำดับแผนก',
            'schedule' => 'ผู้เข้าร่วมโครงการ', // partition
            'year' => 'ปีงบประมาณ',
            'budget' => 'งบประมาณ',
            'summary' => 'สรุปผลงานวิจัยหรือบทคัดย่อ',
            'start' => 'วันเริ่มต้นโครงการ',
            'stop' => 'วันสิ้นสุดโครงการ',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    public function getResearcher ()
    {
        return $this->hasOne (Researcher::className(),['personal_code'=>'personal_code']);
    }

    public function getPartitions()
    {
        return $this->hasMany(ProjectPartitions::className(), ['project_id' => 'id']);
    }
}
