<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use app\models\Faculty;
use app\models\Institution;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Researcher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="researcher-form">

    <?php 
        $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL],
            ['options' => ['enctype' => 'multipart/form-data']]); 
	?>

    <div class="box-body">

<<<<<<< HEAD
    <?php 
        $list = ['1' => 'Yes', '0' => 'No'];
        echo $form->field($researcher, 'foreigner')->radioList($list);
        
        echo $form->field($instit, 'inst_name')->dropdownList(ArrayHelper::map(Institution::find()->all(),
            'inst_code','inst_name'), [
            'id'=>'ddl-institution',
            'options' => [
                $instit->inst_code => ['Selected'=>'selected']], 
                'prompt'=>'เลือกหน่วยงาน']); // id=>inst relation with depends[]
    
        echo $form->field($faculty, 'fac_name')->widget(DepDrop::classname(), [
            'data'=> [],
            'pluginOptions'=>[
                'depends'=>['ddl-institution'],
                'placeholder'=>'เลือกคณะ',
                'url'=>Url::to(['/researcher/get-faculty'])
            ]
        ]);
=======
    <!--?= $form->field($model, 'foreigner')->textInput() ?-->

    <?= $form->field($model, 'foreigner')->radioList(['1' => 'ใช่ / Yes','2' => 'ไม่ใช่ / No',]); ?>
>>>>>>> be2e5ecc3a5c9535a3d14977c4a9c4200b54f69a

        $list = ['1' => 'Male', '0' => 'Female'];
        echo $form->field($researcher, 'gender')->radioList($list);
    ?>

    <?= $form->field($researcher, 'pers_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'firstname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'lastname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'firstname_en')->textInput(['maxlength' => true]) ?>

<<<<<<< HEAD
    <?= $form->field($researcher, 'lastname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'telephone')->textInput(['maxlength' => true]) ?>
=======
    <!--?= $form->field($model, 'fullname_th')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'fullname_en')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'gender')->textInput() ?-->
    
    <?= $form->field($model, 'gender')->radioList(['1' => 'Male','2' => 'Female',]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>
>>>>>>> be2e5ecc3a5c9535a3d14977c4a9c4200b54f69a
	
	<!--<div class="img-responsive center-block">
		<div class="col-md-2">
			<div class="well text-center">
				<?= Html::img($researcher->getPhotoViewer(),['style'=>'width:100px;','class'=>'img-rounded']); ?>
			</div>
		</div>
		<div class="col-md-10">
			<?= $form->field($researcher, 'evidence_file')->fileInput() ?>
		</div>
    </div>-->

    <!--?= $form->field($model, 'update_date')->textInput() ?-->

    <!--?= $form->field($model, 'created_by')->textInput() ?-->

    <!--?= $form->field($model, 'created_date')->textInput() ?-->

    <!--?= $form->field($model, 'update_by')->textInput() ?-->

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
