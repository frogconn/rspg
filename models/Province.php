<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property integer $id
 * @property string $p_code
 * @property string $p_name
 * @property integer $geo_id
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_name'], 'required'],
            [['geo_id'], 'integer'],
            [['p_code'], 'string', 'max' => 2],
            [['p_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_code' => 'P Code',
            'p_name' => 'ชื่อจังหวัด',
            'geo_id' => 'Geo ID',
        ];
    }
}
