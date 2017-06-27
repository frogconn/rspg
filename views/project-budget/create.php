<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectBudget */

$this->title = 'Create Project Budget';
$this->params['breadcrumbs'][] = ['label' => 'Project Budgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-budget-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'proj' => $proj,
        'projB' => $projB,
        'researcher' => $researcher
    ]) ?>

</div>
