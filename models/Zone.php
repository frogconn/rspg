<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zone".
 *
 * @property integer $zone_id
 * @property string $zone_name
 */
class Zone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone_id', 'zone_name'], 'required'],
            [['zone_id'], 'integer'],
            [['zone_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zone_id' => 'Zone ID',
            'zone_name' => 'Zone Name',
        ];
    }
}
