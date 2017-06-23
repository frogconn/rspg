<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property string $id
 * @property integer $fac_id
 * @property string $fac_name
 * @property integer $inst_id
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fac_code', 'inst_code', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
            [['fac_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fac_code' => 'รหัสคณะ',
            'fac_name' => 'ชื่อคณะ',
            'inst_code' => 'รหัสสถาบัน',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
