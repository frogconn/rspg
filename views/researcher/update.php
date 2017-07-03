<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Researcher */

$this->title = $model->title.$model->firstname_th." ".$model->lastname_th;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลนักวิจัย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="researcher-update">

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

    <?= $this->render('_form', [
        'model' => $model,
        'instit' => $instit,
        'faculty' => $faculty,
        'faculty_list' => $faculty_list,
        'agency'=>$agency,
    ]) ?>

</div>
</div>
