<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResearcherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="researcher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($researcher, 'foreigner') ?>

    <?php echo $form->field($researcher, 'gender') ?>

    <?php echo $form->field($researcher, 'pers_id') ?>

    <?php echo $form->field($researcher, 'title') ?>

    <?php echo $form->field($researcher, 'fristname_th') ?>

    <?php echo $form->field($researcher, 'lastname_th') ?>

    <?php echo $form->field($researcher, 'fristname_en') ?>

    <?php echo $form->field($researcher, 'lastname_en') ?>

    <?php echo $form->field($researcher, 'fullname_th') ?>

    <?php echo $form->field($researcher, 'fullname_en') ?>

    <?php echo $form->field($researcher, 'email') ?>

    <?php echo $form->field($researcher, 'telephone') ?>

    <?php echo $form->field($researcher, 'update_date') ?>

    <?php echo $form->field($researcher, 'created_by') ?>

    <?php echo $form->field($researcher, 'created_date') ?>

    <?php echo $form->field($researcher, 'update_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
