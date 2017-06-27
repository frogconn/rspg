<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectBudget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-budget-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($projB, 'year')->dropDownList(range(2549, date('Y') + 544)); ?>

    <?= $form->field($proj, 'proj_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($projB, 'amount_of_budget')->textInput() ?>

    <?= $form->field($researcher, 'fullname_th')->textInput() ?>

    <?php echo $form->field($projB, 'proj_start')->widget('trntv\yii\datetime\DateTimeWidget', [
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

    <?php echo $form->field($projB, 'proj_stop')->widget('trntv\yii\datetime\DateTimeWidget', [
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

    <div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($proj->isNewRecord ? 'Create' : 'Update', ['class' => $proj->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'researcher/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
