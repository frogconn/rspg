<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property string $d_code
 * @property string $d_name
 * @property integer $a_id
 * @property integer $p_id
 * @property integer $geo_id
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['d_name'], 'required'],
            [['a_id', 'p_id', 'geo_id'], 'integer'],
            [['d_code'], 'string', 'max' => 6],
            [['d_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'd_code' => 'D Code',
            'd_name' => 'ชื่อตำบล',
            'a_id' => 'A ID',
            'p_id' => 'P ID',
            'geo_id' => 'Geo ID',
        ];
    }
}
