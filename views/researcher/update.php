<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Researcher */

$this->title = 'Update Researcher: ' . $researcher->title;
$this->params['breadcrumbs'][] = ['label' => 'Researchers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $researcher->title, 'url' => ['view', 'id' => $researcher->pers_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="researcher-update">

    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'researcher'=>$researcher,
        'instit'=>$instit,
        'faculty'=>$faculty,
        'faculty_list'=>$faculty_list
    ]) ?>

</div>
</div>
