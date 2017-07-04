<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_garjan".
 *
 * @property integer $id
 * @property string $year
 * @property string $name
 * @property string $personal_code
 * @property integer $faculty_id
 * @property double $budget
 * @property integer $project_type_id
 * @property string $summary
 * @property string $created_by
 * @property string $created_date
 * @property string $update_by
 * @property string $update_date
 * @property string $start
 * @property string $stop
 */
class ProjectGarjan extends \yii\db\ActiveRecord
{
    public $schedule = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_garjan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date', 'update_date', 'start', 'stop'], 'safe'],
            [['year', 'faculty_id', 'project_type_id'], 'integer'],
            [['budget'], 'number'],
            [['summary'], 'string'],
            [['name', 'created_by', 'update_by'], 'string', 'max' => 255],
            [['personal_code'], 'string', 'max' => 64],
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
            'faculty_id' => 'รหัสคณะ',
            'budget' => 'งบประมาณ',
            'project_type_id' => 'Project Type ID',
            'summary' => 'สรุปผลงานวิจัย',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
            'update_date' => 'Update Date',
            'start' => 'วันเริ่มต้นโครงการ',
            'stop' => 'วันสิ้นสุดโครงการ',
            'schedule' => 'ผู้เข้าร่วมโครงการ'
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