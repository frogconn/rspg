<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use kartik\widgets\ActiveForm;

use app\models\ResourceAnimal;
use app\models\ResourceType;
use app\models\ResearchArea;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceAnimal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-animal-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body">

    <?= $form->field($type, 'name') ->dropdownList(ArrayHelper::map(
        ResourceType::find()->where(['class' => 'สัตว์และแมลง'])->all(), 'id', 'name'), [
                            'id'=>'ddl-type',
                            'options'=>[
                                $type -> id => ['Selected' => 'selected']],
                            'prompt'=>'เลือกประเภทของสัตว์และแมลง'
                        ]);
    ?>

    <?= $form->field($animal, 'common_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'location_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'science_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'family_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'information')->textarea(['rows' => 6]) ?>

    <?= $form->field($area, 'name') ->dropdownList(ArrayHelper::map(
        ResearchArea::find() ->all(), 'id', 'name'), [
                            'id'=>'ddl-area',
                            'options'=>[
                                $area -> id => ['Selected' => 'selected']],
                            'prompt'=>'เลือกพื้นที่วิจัย'
                        ]);
    ?>

    <?= $form->field($animal, 'benefit')->textarea(['rows' => 6]) ?>


    <?php
        echo app\widgets\Upload::widget(['model' => $animal,'required' => false]);
    ?>



	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($animal->isNewRecord ? 'Create' : 'Update', ['class' => $animal->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'resource-animal/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
