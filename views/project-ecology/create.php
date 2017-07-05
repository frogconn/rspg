<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectEcology */

$this->title = 'Create Project Ecology';
$this->params['breadcrumbs'][] = ['label' => 'Project Ecologies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-ecology-create">


<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'project' => $project,
        'type' => $type
    ]) ?>

</div>

</div>
