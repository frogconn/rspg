<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $img_code
 * @property string $img_name
 * @property string $img_size
 * @property string $img_type
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img_code'], 'integer'],
            [['img_name'], 'string', 'max' => 128],
            [['img_size'], 'string', 'max' => 64],
            [['img_type'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_code' => 'Img Code',
            'img_name' => 'Img Name',
            'img_size' => 'Img Size',
            'img_type' => 'Img Type',
        ];
    }
}
