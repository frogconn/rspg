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

    <?php

        $list = ['Y' => 'Yes', 'N' => 'No'];
        echo $form->field($researcher, 'is_foreigner')->radioList($list);
        
        echo $form->field($institution, 'name')->dropdownList(ArrayHelper::map(ResearcherInstitution::find()->all(),
            'id','name'), [
            'id'=>'ddl-institution',
            'options' => [
            $institution->id => ['Selected'=>'selected']], 
            'prompt'=>'เลือกหน่วยงาน']); // id=>inst relation with depends[]
    
        echo $form->field($faculty, 'name')->widget(DepDrop::classname(), [
            'data'=> $faculty_list,
            'pluginOptions'=>[
            'depends'=>['ddl-institution'],
            'placeholder'=>'เลือกคณะ',
            'url'=>Url::to(['/researcher/get-faculty'])
            ]
        ]);

        $list = ['M' => 'Male', 'F' => 'Female'];
        echo $form->field($researcher, 'gender')->radioList($list);
    ?>
	
	<?= $form->field($researcher, 'personal_code')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($researcher, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'firstname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'lastname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'firstname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'lastname_en')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'fullname_th')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'fullname_en')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?-->

    <?= $form->field($researcher, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'evidence_file')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'created_date')->textInput() ?-->

    <!--?= $form->field($model, 'created_by')->textInput() ?-->

    <!--?= $form->field($model, 'updated_date')->textInput() ?-->

    <!--?= $form->field($model, 'updated_by')->textInput() ?-->


	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($researcher->isNewRecord ? 'Create' : 'Update', ['class' => $researcher->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'researcher/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
