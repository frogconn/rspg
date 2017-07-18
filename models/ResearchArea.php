<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "research_area".
 *
 * @property string $id
 * @property string $name
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class ResearchArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'research_area';
    }

    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[], 'required'],
            [['created_date', 'updated_date' ,'name'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับชื่อพื้นที่วิจัย',
            'name' => 'พื้นที่วิจัย',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
    // new code
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            if($this->isNewRecord)
            {
                $this->created_date = new \yii\db\Expression('NOW()');
            }
             $this->updated_date = new \yii\db\Expression('NOW()');
            return true;
        }
        return false;
    }

}
