<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $proj_id
 * @property string $proj_name
 * @property string $pers_id
 * @property integer $dep_id
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proj_id'], 'required'],
            [['dep_id', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
            [['proj_id', 'pers_id'], 'string', 'max' => 64],
            [['proj_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'proj_id' => 'รหัสโครงการ',
            'proj_name' => 'ชื่อโครงการ',
            'pers_id' => 'รหัสนักวิจัย',
            'dep_id' => 'รหัสแผนก',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
