<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;

use app\models\AddressProvince;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-area-information-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body">


    <?= $form->field($researchArea, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($provinceid, 'name')->dropdownList(ArrayHelper::map(
        AddressProvince::find()->all(), 'id', 'name'), [
                'id'=>'ddl-province',
                'options' => [
                    $provinceid->id => ['Selected'=>'selected']],
                'prompt'=>'เลือกจังหวัด'
            ]); 
    ?>

    <?= $form->field($amphurid, 'name')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-amphur'],
            'data'=> $amphur_list,
            'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ',
                'url'=>Url::to(['/research-area-information/get-amphur'])
            ]
        ]); 
    ?>

    <?= $form->field($districtid, 'name')->widget(DepDrop::classname(), [
			'options'=>['id'=>'ddl-district'],
			'data' => $district_list,
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
