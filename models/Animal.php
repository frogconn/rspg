<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property integer $id
 * @property integer $animal_id
 * @property string $com_name
 * @property string $loc_name
 * @property string $sc_name
 * @property string $fam_name
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
class Animal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['animal_id'], 'required'],
            [['animal_id', 'zone_id', 'img_code', 'type_id', 'created_by', 'update_by'], 'integer'],
            [['gen_info', 'banefit'], 'string'],
            [['update_date', 'created_date'], 'safe'],
            [['com_name', 'loc_name', 'sc_name', 'fam_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'animal_id' => 'Animal ID',
            'com_name' => 'Com Name',
            'loc_name' => 'Loc Name',
            'sc_name' => 'Sc Name',
            'fam_name' => 'Fam Name',
            'gen_info' => 'Gen Info',
            'zone_id' => 'Zone ID',
            'banefit' => 'Banefit',
            'img_code' => 'Img Code',
            'type_id' => 'Type ID',
            'update_date' => 'Update Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'update_by' => 'Update By',
        ];
    }
}
