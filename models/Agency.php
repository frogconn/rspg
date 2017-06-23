<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agency".
 *
 * @property string $id
 * @property integer $pers_id
 * @property integer $fac_id
 * @property integer $inst_id
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class Agency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pers_id', 'fac_code', 'inst_code', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pers_id' => 'หมายเลขบัตรประชาชน/หมายเลขหนังสือเดินทาง',
            'fac_code' => 'รหัสคณะ',
            'inst_code' => 'รหัสสถาบัน',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
