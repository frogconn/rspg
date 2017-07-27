<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResearcherInstitution */

$this->title = 'Update Researcher Institution: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Researcher Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="researcher-institution-update">

    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
