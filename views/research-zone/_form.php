<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;

use app\models\Province;
use app\models\Amphur;
use app\models\District;
use app\models\Region;
/* @var $this yii\web\View */
/* @var $model app\models\ResearchZone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-zone-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body">

    <?= $form->field($model, 'zone_id')->textInput() ?>

    <?= $form->field($model, 'zone_name')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'province_id')->textInput() ?-->
	<!--?=
		$form->field($model, 'province_id')->dropDownList(
		ArrayHelper::map(Province::find()->all(), 'id', 'name'), ['prompt' => '-- โปรดเลือก --'])
	?-->
	<?= $form->field($model, 'province_id')->dropdownList(
            ArrayHelper::map(Province::find()->all(),
            'id',
            'name'),
            [
                'id'=>'ddl-province',
                'prompt'=>'เลือกจังหวัด'
			]);
	?>

    <!--?= $form->field($model, 'amphur_id')->textInput() ?-->
	<?= 
		$form->field($model, 'amphur_id')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-amphur'],
            'data'=> [],
            'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ...',
                'url'=>Url::to(['/research-zone/get-amphur'])
            ]
        ]); 
	?>
    <!--?= $form->field($model, 'district_id')->textInput() ?-->
	<?= 
		$form->field($model, 'district_id')->widget(DepDrop::classname(), [
			'data' =>[],
			'pluginOptions'=>[
				'depends'=>['ddl-province', 'ddl-amphur'],
				'placeholder'=>'เลือกตำบล...',
				'url'=>Url::to(['/research-zone/get-district'])
			]
		]);
	?>

    <?= $form->field($model, 'region_id')->textInput() ?>

    <?= $form->field($model, 'img_id')->textInput() ?>

    <?= $form->field($model, 'information')->textarea(['rows' => '6']) ?>

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
                 <?= Html::a('Cancle',[ 'research-zone/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
