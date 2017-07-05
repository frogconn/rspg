<?php

namespace app\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'created_date', 'updated_date'], 'safe'],
            [['faculty_id', 'type_id'], 'integer'],
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
            'faculty_id' => 'คณะ',
            'budget' => 'งบประมาณ',
            'summary' => 'สรุปผลงานวิจัย',
            'type_id' => 'รหัสด้าน',
            'created_by' => 'สร้างโดย',
            'created_date' => 'สร้างเมื่อ',
            'updated_by' => 'อัพเดตโดย',
            'updated_date' => 'อัพเดตเมื่อ',
            'schedule' => 'ผู้เข้าร่วมโครงการ',
            'start' => 'วันเริ่มต้นโครงการ',
            'stop' => 'วันสิ้นสุดโครงการ'

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

    public function getProjectType(){
        return $this->hasOne(ProjectType::className(),['id'=>'type_id']);
    }
}
