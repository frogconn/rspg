<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;

use app\models\AddressProvince;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-area-information-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body">


    <?= $form->field($researchArea, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($province, 'name')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(AddressProvince::find()->all(), 'id', 'name'),
            'language' => 'th',
            'options' => [
                'value' => $province->id,
                'placeholder' => 'เลือกจังหวัด',
                'id' => 'ddl-province',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($amphur, 'name')->widget(DepDrop::classname(), [
            'data'=> $amphur_list,
            'options'=>['id'=>'ddl-amphur'],
            'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ',
                'url'=>Url::to(['/research-area-information/get-amphur'])
            ]
        ]); 
    ?>

    <?= $form->field($district, 'name')->widget(DepDrop::classname(), [
			'data' => $district_list,
            'options'=>['id'=>'ddl-district'],
			'pluginOptions'=>[
				'depends'=>['ddl-province', 'ddl-amphur'],
				'placeholder'=>'เลือกตำบล',
				'url'=>Url::to(['/research-area-information/get-district'])
           ]
        ]); 
    ?>

    <?= $form->field($information, 'information')->textarea(['rows' => '4']) ?>

	</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($researchArea->isNewRecord ? 'Create' : 'Update', ['class' => $researchArea->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'research-area-information/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    document.getElementById('ddl-amphur').value="<?php echo $amphur->id; ?>";
    document.getElementById('ddl-district').value="<?php echo $district->id; ?>";
</script>
