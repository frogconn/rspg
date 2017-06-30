<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body">

    <?= $form->field($project, 'year')->dropDownList(range(2549, date('Y') + 544)); ?>

    <?= $form->field($project, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'fullname_th')->label('หัวหน้าโครงการ') ?>

    <?= $form->field($project, 'budget')->textInput() ?>

    <?php echo $form->field($project, 'start')->widget('trntv\yii\datetime\DateTimeWidget', [
        'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
            'allowInputToggle' => false,
            'sideBySide' => true,
            'locale' => 'th-th',
            'widgetPositioning' => [
               'horizontal' => 'auto',
               'vertical' => 'auto'
            ]
        ]
    ]); ?>

    <?php echo $form->field($project, 'stop')->widget('trntv\yii\datetime\DateTimeWidget', [
        'phpDatetimeFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
            'allowInputToggle' => false,
            'sideBySide' => true,
            'locale' => 'th-th',
            'widgetPositioning' => [
               'horizontal' => 'auto',
               'vertical' => 'auto'
            ]
        ]
    ]); ?>

    <!--<?php// $form->field($model, 'created_date')->textInput() ?>

    <?php// $form->field($model, 'created_by')->textInput() ?>

    <?php// $form->field($model, 'updated_date')->textInput() ?>

    <?php// $form->field($model, 'updated_by')->textInput() ?>-->


	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($project->isNewRecord ? 'Create' : 'Update', ['class' => $project->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'project/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
