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

    <div class="col-xs-5">
        <p></p>
        <?= Html::activeTextInput($model, 'searchAll',['class'=>'form-control','placeholder'=>'ค้นหาข้อมูล...']) ?>
    </div>
    
    <div class="col-xs-3">
        <?php $list = ['' => 'ทั้งหมด','Y' => 'ใช่', 'N' => 'ไม่ใช่'];
	    echo $form->field($model, 'is_foreigner')->dropdownList($list); ?>
	</div>

    <div class="col-xs-2">
        <?php $list = ['' => 'ทั้งหมด','M' => 'ชาย', 'F' => 'หญิง'];
	    echo $form->field($model, 'gender')->dropdownList($list); ?>
    </div>
	<!--?= $form->field($model, 'id') ?-->

    <!--?= $form->field($model, 'personal_code') ?-->

    <!--?= $form->field($model, 'is_foreigner') ?-->

    <!--?= $form->field($model, 'title') ?-->

    <!--?= $form->field($model, 'firstname_th') ?-->

    <?php // echo $form->field($model, 'lastname_th') ?>

    <?php // echo $form->field($model, 'firstname_en') ?>

    <?php // echo $form->field($model, 'lastname_en') ?>

    <?php // echo $form->field($model, 'fullname_th') ?>

    <?php // echo $form->field($model, 'fullname_en') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'telephone') ?>

    <?php // echo $form->field($model, 'evidence_file') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="col-xs-2">
        <div class="form-group">
            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
            <!--?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?-->
            <?= Html::a('ยกเลิก', ['reset'], ['class' => 'btn btn-default']) ?>
        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
