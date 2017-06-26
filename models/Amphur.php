<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "amphur".
 *
 * @property integer $id
 * @property string $a_code
 * @property string $a_name
 * @property integer $geo_id
 * @property integer $p_id
 */
class Amphur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amphur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_name'], 'required'],
            [['geo_id', 'p_id'], 'integer'],
            [['a_code'], 'string', 'max' => 5],
            [['a_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'a_code' => 'A Code',
            'a_name' => 'ชื่ออำเภอ',
            'geo_id' => 'Geo ID',
            'p_id' => 'P ID',
        ];
    }
}
