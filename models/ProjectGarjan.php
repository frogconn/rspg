<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_garjan".
 *
 * @property integer $id
 * @property integer $year
 * @property string $name
 * @property string $personal_code
 * @property integer $faculty_id
 * @property double $budget
 * @property integer $type_id
 * @property string $summary
 * @property string $start
 * @property string $stop
 * @property string $created_by
 * @property string $created_date
 * @property string $update_by
 * @property string $update_date
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
            [['year', 'faculty_id', 'type_id'], 'integer'],
            [['budget'], 'number'],
            [['summary'], 'string'],
            [['start', 'stop', 'created_date', 'update_date'], 'safe'],
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
            'schedule' => 'ผู้เข้าร่วมโครงการ',
            'budget' => 'งบประมาณ',
            'type_id' => 'รหัสประเภทของโครงการ',
            'summary' => 'สรุปผลงานวิจัย',
            'start' => 'วันเริ่มต้นโครงการ',
            'stop' => 'วันสิ้นสุดโครงการ',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
            'update_date' => 'Update Date',
        ];
    }
}
