<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_budget".
 *
 * @property integer $proj_id
 * @property integer $year
 * @property integer $amount_of_budget
 * @property string $proj_start
 * @property string $proj_stop
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class ProjectBudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'amount_of_budget', 'created_by', 'update_by'], 'integer'],
            [['proj_start', 'proj_stop', 'update_date', 'created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'proj_id' => 'รหัสโครงการ',
            'year' => 'ปีงบประมาณ',
            'amount_of_budget' => 'เงินรวม',
            'proj_start' => 'วันเริ่มต้นโครงการ',
            'proj_stop' => 'วันสิ้นสุดโครงการ',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
