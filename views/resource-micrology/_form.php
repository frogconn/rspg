<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use kartik\widgets\ActiveForm;

use app\models\ResourceMicrology;
use app\models\ResourceType;
use app\models\ResearchArea;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceMicrology */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-micrology-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body">

    <?= $form ->field($type, 'name')->dropdownList (ArrayHelper::map(
        ResourceType::find()->where (['class' => 'จุลินทรีย์'])->all(), 'id','name'),[
                'id'=>'ddl-type',
                'options'=>[
                    $type -> id => ['Selected'=>'selected']],
                'prompt'=>'เลือกประเภทจุลินทรีย์'
        ]);
    ?>

    <?= $form->field($micro, 'genus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($micro, 'species')->textInput(['maxlength' => true]) ?>

    <?= $form->field($micro, 'information')->textarea(['rows' => 6]) ?>

    <?= $form ->field($area, 'name')->dropdownList (ArrayHelper::map(
        ResearchArea::find()->all(), 'id','name'),[
                'id'=>'ddl-area',
                'options'=>[
                    $area -> id => ['Selected'=>'selected']],
                'prompt'=>'เลือกพื้นที่วิจัย'
        ]);
    ?>

    <?= $form->field($micro, 'benefit')->textarea(['rows' => 6]) ?>


    <?php
        echo app\widgets\Upload::widget(['model' => $micro,'required' => false]);
    ?>

	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($micro->isNewRecord ? 'Create' : 'Update', ['class' => $micro->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'resource-micrology/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
