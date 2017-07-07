<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attach_files".
 *
 * @property integer $id
 * @property string $name
 * @property string $model
 * @property integer $itemId
 * @property string $hash
 * @property integer $size
 * @property string $type
 * @property string $mime
 */
class AttachFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attach_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'model', 'itemId', 'hash', 'size', 'type', 'mime'], 'required'],
            [['itemId', 'size'], 'integer'],
            [['name', 'model', 'hash', 'type', 'mime'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ไฟล์',
            'model' => 'Model',
            'itemId' => 'Item ID',
            'hash' => 'Hash',
            'size' => 'Size',
            'type' => 'Type',
            'mime' => 'Mime',
        ];
    }
		public function getPhotoViewer()
	{
		return empty($this->name) ? Yii::getAlias('@web').'/img/none.png' : '@web'.'/uploads/files/'.$this->name;
	}
}
