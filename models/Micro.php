<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "micro".
 *
 * @property integer $id
 * @property string $genus
 * @property integer $mic_id
 * @property string $species
 * @property string $gen_info
 * @property integer $zone_id
 * @property string $banefit
 * @property integer $img_code
 * @property integer $type_id
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class Micro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'micro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mic_id', 'zone_id', 'img_code', 'type_id', 'created_by', 'update_by'], 'integer'],
            [['gen_info', 'banefit'], 'string'],
            [['update_date', 'created_date'], 'safe'],
            [['genus', 'species'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'genus' => 'ชื่อประเภท',
            'mic_id' => 'หมายเลขจุลินทรีย์',
            'species' => 'ชื่อสายพันธุ์',
            'gen_info' => 'ข้อมูลทั่วไป',
            'zone_id' => 'รหัสพื้นที่',
            'banefit' => 'ประโยชน์',
            'img_code' => 'รหัสรูปภาพ',
            'type_id' => 'รหัสประเภท',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
