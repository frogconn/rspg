<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformation */

$this->title = 'Update Research Area Information: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Research Area Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="research-area-information-update">

    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
