<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectGarjan */

$this->title = $project->name;
$this->params['breadcrumbs'][] = ['label' => 'โครงการยางนา', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => ['view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="project-garjan-update">

    <div class="box box-success">
            <div class="box-header with-border">
              <!--h3 class="box-title"!--><!--?= Html::encode($this->title) ?--></h3>
            </div>

    <?= $this->render('_form', [
        'project' => $project,
        'type' => $type,
        'faculty' => $faculty,
        'type_list' => $type_list,
        'faculty_list' => $faculty_list
    ]) ?>

</div>
</div>
