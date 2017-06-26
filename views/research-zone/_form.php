<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use kartik\widgets\DepDrop;

use app\models\Province;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchZone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-zone-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($zone, 'zone_name')->textInput() ?>

    <?= $form->field($province, 'p_name')->dropdownList(ArrayHelper::map(
        Province::find()->all(), 'id', 'p_name'), [
                'id'=>'ddl-province',
                'options' => [
                    $province->id => ['Selected'=>'selected']],
                'prompt'=>'เลือกจังหวัด'
            ]); 
    ?>

    <?= $form->field($amphur, 'a_name')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-amphur'],
            'data'=> $amphur_list,
            'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ',
                'url'=>Url::to(['/research-zone/get-amphur'])
            ]
        ]); 
    ?>

    <?= $form->field($district, 'd_name')->widget(DepDrop::classname(), [
           'data' => $district_list,
           'pluginOptions'=>[
               'depends'=>['ddl-province', 'ddl-amphur'],
               'placeholder'=>'เลือกตำบล',
               'url'=>Url::to(['/research-zone/get-district'])
           ]
        ]); 
    ?>

    <?= $form->field($researchZone, 'gen_info')->textarea(['rows' => '4']) ?>

    <div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($zone->isNewRecord ? 'Create' : 'Update', ['class' => $zone->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'researcher/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    document.getElementById('amphur-a_name').value="<?php echo $amphur->id; ?>";
    document.getElementById('district-d_name').value="<?php echo $district->id; ?>";
</script>
