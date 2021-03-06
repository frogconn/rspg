<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_type".
 *
 * @property integer $id
 * @property string $topic
 * @property string $sub_topic
 * @property string $type
 */
class ProjectType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic', 'sub_topic', 'type'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับด้าน',
            'topic' => 'กลุ่ม', // หัวข้อใหญ่
            'sub_topic' => 'กรอบกิจกรรม', // หัวข้อย่อย
            'type' => 'ประเภท',
        ];
    }
}
