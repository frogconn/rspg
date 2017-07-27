<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectGarjan */

$this->title = 'สร้างโครงการยางนาใหม่';
$this->params['breadcrumbs'][] = ['label' => 'โครงการยางนา', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-garjan-create">


<div class="box box-success">
            <div class="box-header with-border">
              <!--h3 class="box-title"--><!--?= Html::encode($this->title) ?--></h3>
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
