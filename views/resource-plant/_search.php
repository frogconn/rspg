<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResourcePlantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-plant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        
    ]); ?>
	
	
	<?= $form->field($searchModel, 'type_name') ?>

    <?= $form->field($searchModel, 'common_name') ?>

    <?= $form->field($searchModel, 'location_name') ?>

    <?= $form->field($searchModel, 'science_name') ?>
	
	<?= $form->field($searchModel, 'family_name') ?>
	
	<?= $form->field($searchModel, 'zone_name') ?>

    

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    <div class="input-group">

   </div>

    <?php ActiveForm::end(); ?>



</div>
