<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "researcher_agency".
 *
 * @property string $id
 * @property string $personal_code
 * @property integer $researcher_id
 * @property string $faculty_id
 * @property string $institution_id
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class ResearcherAgency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'researcher_agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personal_code'], 'required'],
            [['researcher_id','faculty_id', 'institution_id', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['personal_code'], 'string', 'max' => 63],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับหน่วยงาน',
            'personal_code' => 'หมายเลขบัตรประชาชน/หมายเลขหนังสือเดินทาง',
            'researcher_id' => 'researcher_id',
            'faculty_id' => 'ลำดับคณะ',
            'institution_id' => 'ลำดับสถาบัน',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
}
