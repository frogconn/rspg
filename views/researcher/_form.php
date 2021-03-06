<?php

use app\models\ResearcherInstitution;
use app\models\ResearcherFaculty;

use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Researcher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="researcher-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL],
	[
    'options' => ['enctype' => 'multipart/form-data']
	]); ?>

    <div class="box-body">

    <?php $list = ['Y' => 'ใช่/Yes', 'N' => 'ไม่ใช่/No'];
    echo $form->field($model, 'is_foreigner')->radioList($list); ?>

    <?= $form->field($model, 'personal_code')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'is_foreigner')->textInput(['maxlength' => true]) ?-->

    <?= $form->field($agency, 'institution_id')->dropdownList(
        ArrayHelper::map(ResearcherInstitution::find()->all(),
            'id',
            'name'),
            [
                //'data'=> $instit_list,
                'id'=>'ddl-institution',
                'prompt'=>'เลือกสถาบัน'
            ]); 
    ?>

    <?= $form->field($agency, 'faculty_id')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-faculty'],
            'data'=> $faculty_list,
            'pluginOptions'=>[
                'depends'=>['ddl-institution'],
                'placeholder'=>'เลือกคณะ',
                'url'=>Url::to(['/researcher/get-faculty'])
            ]
        ]); 
    ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname_en')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'fullname_th')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'fullname_en')->textInput(['maxlength' => true]) ?-->

    <?php $list = ['M' => 'ชาย/Male', 'F' => 'หญิง/Female'];
    echo $form->field($model, 'gender')->radioList($list); ?>
    <!--?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?-->

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

	<?php
       echo app\widgets\Upload::widget(['model' => $model,'required' => false]);
	?>

	
    <!--div class="row">
        <div class="col-md-2">
        <div class="well text-center">
            <?= Html::img($model->getPhotoViewer(),['style'=>'width:100px;','class'=>'img-rounded']); ?>
        </div>
        </div>
        <div class="col-md-10">
            <?= $form->field($model, 'evidence_file')->fileInput() ?>
        </div>
    </div-->

	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'แก้ไขข้อมูล', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('ยกเลิก',[ 'researcher/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
