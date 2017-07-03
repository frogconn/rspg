<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_partitions".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $position
 * @property integer $telephone
 * @property string $email
 * @property integer $project_id
 */
class ProjectPartitions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_partitions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'integer'],
            [['fullname', 'email'], 'string', 'max' => 255],
            [['telephone', 'position'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสผู้ร่วมโครงการ',
            'fullname' => 'ชื่อ-นามสกุล',
            'position' => 'ตำแหน่ง(ทางวิชาการ)',
            'telephone' => 'เบอร์โทรศัพท์',
            'email' => 'e-mail',
            'project_id' => 'รหัสโครงการ',
        ];
    }

}
