<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\Depdrop;
use app\models\ResearcherFaculty;
use app\models\ResearcherInstitution;

/* @var $this yii\web\View */
/* @var $model app\models\Researcher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="researcher-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body">

    <!--?= $form->field($model, 'is_foreigner')->textInput(['maxlength' => true]) ?-->
	<?= $form->field($model, 'is_foreigner')->radioList(['Y' => 'ใช่ / Yes','N' => 'ไม่ใช่ / No',]); ?>
	
	<?= $form->field($model, 'personal_code')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname_en')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'fullname_th')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'fullname_en')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?-->
	<?= $form->field($model, 'gender')->radioList(['M' => 'Male','F' => 'Female',]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'evidence_file')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'created_date')->textInput() ?-->

    <!--?= $form->field($model, 'created_by')->textInput() ?-->

    <!--?= $form->field($model, 'updated_date')->textInput() ?-->

    <!--?= $form->field($model, 'updated_by')->textInput() ?-->


	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'researcher/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
