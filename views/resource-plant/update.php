<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResourcePlant */

$this->title = 'Update Resource Plant: ' . $plant->common_name;
$this->params['breadcrumbs'][] = ['label' => 'Resource Plants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $plant->id, 'url' => ['view', 'id' => $plant->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resource-plant-update">

    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'plant' => $plant,
        'type'  => $type,
        'researchArea' => $researchArea
            ]);
     ?>

</div>
</div>
