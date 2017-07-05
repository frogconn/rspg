<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectEcology */

$this->title = '' . $project->name;
$this->params['breadcrumbs'][] = ['label' => 'Project Ecologies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $project->name, 'url' => ['view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-ecology-update">

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

    <?= $this->render('_form', [
        'project' => $project,
        'type' => $type
    ]) ?>

</div>
</div>
