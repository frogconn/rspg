<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "researcher".
 *
 * @property string $id
 * @property string $personal_code
 * @property string $is_foreigner
 * @property string $title
 * @property string $firstname_th
 * @property string $lastname_th
 * @property string $firstname_en
 * @property string $lastname_en
 * @property string $fullname_th
 * @property string $fullname_en
 * @property string $gender
 * @property string $email
 * @property string $telephone
 * @property string $evidence_file
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class Researcher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'researcher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personal_code', 'is_foreigner', 'title', 'firstname_th', 'lastname_th', 'firstname_en', 'lastname_en', 'gender', 'email', 'telephone'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['personal_code', 'title', 'telephone'], 'string', 'max' => 63],
            [['is_foreigner', 'gender'], 'string', 'max' => 1],
            [['firstname_th', 'lastname_th', 'firstname_en', 'lastname_en', 'email'], 'string', 'max' => 127],
            [['fullname_th', 'fullname_en', 'evidence_file'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'personal_code' => 'หมายเลขบัตรประชาชน/หมายเลขหนังสือเดินทาง',
            'is_foreigner' => 'ชาวต่างชาติ',
            'title' => 'คำนำหน้าชื่อ',
            'firstname_th' => 'ชื่อ',
            'lastname_th' => 'นามสกุล',
            'firstname_en' => 'Firstname',
            'lastname_en' => 'Lastname',
            'fullname_th' => 'ชื่อเต็ม',
            'fullname_en' => 'Fullname',
            'gender' => 'เพศ',
            'email' => 'อีเมล',
            'telephone' => 'เบอร์โทรศัพท์',
            'evidence_file' => 'ไฟล์หลักฐาน',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
    public function beforeSave($insert)
    {
        $this->fullname_th = $this->firstname_th." ".$this->lastname_th;
        $this->fullname_en = $this->firstname_en." ".$this->lastname_en;
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
