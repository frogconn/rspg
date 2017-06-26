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

    <?php 
        $list = ['Yes' => 'Yes', 'No' => 'No'];
        echo $form->field($researcher, 'foreigner')->radioList($list);
        
        echo $form->field($instit, 'inst_name')->dropdownList(ArrayHelper::map(Institution::find()->all(),
            'inst_code','inst_name'), [
            'id'=>'ddl-institution',
            'options' => [
                $instit->inst_code => ['Selected'=>'selected']], 
                'prompt'=>'เลือกหน่วยงาน']); // id=>inst relation with depends[]
    
        echo $form->field($faculty, 'fac_name')->widget(DepDrop::classname(), [
            'data'=> $faculty_list,
            'pluginOptions'=>[
                'depends'=>['ddl-institution'],
                'placeholder'=>'เลือกคณะ',
                'url'=>Url::to(['/researcher/get-faculty'])
            ]
        ]);

        $list = ['Male' => 'Male', 'Female' => 'Female'];
        echo $form->field($researcher, 'gender')->radioList($list);
    ?>

    <?= $form->field($researcher, 'pers_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'firstname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'lastname_th')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'firstname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'lastname_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($researcher, 'telephone')->textInput(['maxlength' => true]) ?>
	
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

<script>
    document.getElementById('faculty-fac_name').value="<?php echo $faculty->fac_code; ?>";
</script>
