<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property string $id
 * @property integer $geo_id
 * @property string $geo_name
 * @property string $update_date
 * @property integer $created_by
 * @property string $created_date
 * @property integer $update_by
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['geo_id', 'created_by', 'update_by'], 'integer'],
            [['update_date', 'created_date'], 'safe'],
            [['geo_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'geo_id' => 'Geo ID',
            'geo_name' => 'Geo Name',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
