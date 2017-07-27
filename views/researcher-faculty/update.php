<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResearcherFaculty */

$this->title = 'Update Researcher Faculty: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Researcher Faculties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="researcher-faculty-update">

    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
