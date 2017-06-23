<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use app\models\Faculty;
use app\models\Institution;

/* @var $this yii\web\View */
/* @var $model app\models\Researcher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="researcher-form">

    <?php $form = ActiveForm::begin(
	['type' => ActiveForm::TYPE_HORIZONTAL],
	['options' => ['enctype' => 'multipart/form-data']]
	); 
	?>

    <div class="box-body">

    <?= $form->field($model, 'foreigner')->textInput() ?>

    <!--?= $form->field($model, 'institution_id')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'faculty_id')->textInput(['maxlength' => true]) ?-->
	
	<?=$form->field($model, 'institution_id')->dropDownList(
		ArrayHelper::map(Institution::find()->all(), 'id', 'inst_name'), ['prompt' => '-- โปรดเลือก --'])
	?>
	
	<?=$form->field($model, 'faculty_id')->dropDownList(
		ArrayHelper::map(Faculty::find()->all(), 'id', 'fac_name'), ['prompt' => '-- โปรดเลือก --'])
	?>

    <?= $form->field($model, 'pers_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fristname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fristname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>
	
	<div class="img-responsive center-block">
		<div class="col-md-2">
			<div class="well text-center">
				<?= Html::img($model->getPhotoViewer(),['style'=>'width:100px;','class'=>'img-rounded']); ?>
			</div>
		</div>
		<div class="col-md-10">
			<?= $form->field($model, 'evidence_file')->fileInput() ?>
		</div>
    </div>

    <!--?= $form->field($model, 'update_date')->textInput() ?-->

    <!--?= $form->field($model, 'created_by')->textInput() ?-->

    <!--?= $form->field($model, 'created_date')->textInput() ?-->

    <!--?= $form->field($model, 'update_by')->textInput() ?-->

	

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
