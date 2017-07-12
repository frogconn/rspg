<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResourcePlant */

$this->title = $plant->common_name;
$this->params['breadcrumbs'][] = ['label' => 'ทรัพยากรพืช', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $plant->common_name, 'url' => ['view', 'id' => $plant->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="resource-plant-update">

    <div class="box box-success">
            <!-- class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

    <?= $this->render('_form', [
        'plant' => $plant,
        'type'  => $type,
        'researchArea' => $researchArea
            ]);
     ?>

</div>
</div>
