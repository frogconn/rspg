<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceAnimal */

$this->title = $animal->common_name;
$this->params['breadcrumbs'][] = ['label' => 'ทรัพยากรสัตว์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $animal->common_name, 'url' => ['view', 'id' => $animal->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="resource-animal-update">

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

    <?= $this->render('_form', [
        		'animal' => $animal,
                'type'   => $type,
                'area'   => $area,
    ]) ?>

</div>
</div>
