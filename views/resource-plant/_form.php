<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;

use app\models\ResourceType;
use app\models\ResearchArea;

/* @var $this yii\web\View */
/* @var $model app\models\ResourcePlant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-area-information-form">

  <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

  <div class="box-body">

  <?= $form->field($type, 'name')->dropdownList(ArrayHelper::map(
        ResourceType::find()->where(['class' => 'พืช']) ->all(), 'id', 'name'), [
                'id'=>'ddl-type',
                'options' => [
                    $type->id => ['Selected'=>'selected']],
                'prompt'=>'เลือกชนิดของพืช'
            ]);
  ?>
  <?= $form->field($plant, 'common_name')->textInput(['maxlength' => true]) ?>
  <?= $form->field($plant, 'location_name')->textInput(['maxlength' => true]) ?>
  <?= $form->field($plant, 'science_name')->textInput(['maxlength' => true]) ?>
  <?= $form->field($plant, 'family_name')->textInput(['maxlength' => true]) ?>
  <?= $form->field($plant, 'information')->textarea(['rows' => '4']) ?>

  <?= $form->field($researchArea, 'name')->dropdownList(ArrayHelper::map(
        ResearchArea::find()->all(), 'id', 'name'), [
                'id'=>'',
                'options' => [
                    $researchArea->id => ['Selected'=>'selected']],
                'prompt'=>'เลือกพื้นที่วิจัยที่พบ'
            ]);
  ?>

   <?= $form->field($plant, 'benefit')->textarea(['rows' => '4']) ?>


   <?php
       echo app\widgets\Upload::widget(['model' => $plant,'required' => false]);
   ?>


	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($plant->isNewRecord ? 'สร้าง' : 'แก้ไขข้อมูล', ['class' => $plant->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('ยกเลิก',['index-admin'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
