<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "institution".
 *
 * @property string $id
 * @property integer $inst_id
 * @property string $inst_name
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class Institution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'institution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inst_id', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
            [['inst_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inst_id' => 'รหัสสถาบัน',
            'inst_name' => 'ชื่อสถาบัน',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
