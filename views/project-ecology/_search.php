<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectEcologySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-ecology-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        
    ]); ?>

ty_id
     <?= $form->field($searchModel, 'type')?>

    <?= $form->field($searchModel, 'year') ?>

    <?= $form->field($searchModel, 'name') ?>

    <?= $form->field($searchModel, 'fullname_th') ?>

     <?= $form->field($searchModel, 'fuculty_id') ?>

    <?php ActiveForm::end(); ?>

</div>
