<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use kartik\widgets\ActiveForm;
use kartik\select2\Select2;

use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\examples\models\ExampleModel;

use app\models\Researcher;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'enableAjaxValidation'      => true,
        'enableClientValidation'    => false,
        'validateOnChange'          => false,
        'validateOnSubmit'          => true,
        'validateOnBlur'            => false,
        ]); 
    ?>

    <div class="box-body">

    <?php
        Html::dropDownList('listname', $select, ['M'=>'Male', 'F'=>'Female']);
    ?>

    <?php echo $form->field($project, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
            'yearStart' => 2549,
            'yearStartType' => 'fix',
            'yearEnd' => 544,
        ]);
    ?>

    <?= $form->field($project, 'name')->textInput(['maxlength' => true]) ?>
    <!-- Normal select with ActiveForm & model -->
    <?php echo $form->field($project, 'personal_code')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Researcher::find()->all(), 'personal_code', 'fullname_th'),
            'language' => 'th',
            'options' => ['placeholder' => 'เลือกหัวหน้าโครงการ'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($project, 'schedule')->widget(MultipleInput::className(), [
            'columns' => [
            //column 1
                [
                    'name'  => 'fullname',
                    'title' => 'ชื่อ-นามสกุล',
                    'enableError' => true,
                    'options' => [
                    'class' => 'input-priority'
                    ]
                ],
            //column 2
                [
                    'name'  => 'position',
                    'title' => 'ตำแหน่ง(ทางราชการ)',
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ],
            //column 3
                [
                    'name'  => 'telephone',
                    'title' => 'หมายเลขโทรศัพท์',
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ],
            //column 4
                [
                    'name'  => 'email',
                    'title' => 'E-mail',
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ]
            ],
            'addButtonOptions' => [
                'class' => 'btn btn-success'
            ]
        ]);
    ?>

    <?= $form->field($project, 'budget')->textInput() ?>

    <?= $form->field($project, 'summary')->textarea(['rows' => '10']) ?>

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
