<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResourceAnimal */

$this->title = 'Create Resource Animal';
$this->params['breadcrumbs'][] = ['label' => 'Resource Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-animal-create">


<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'animal' => $animal,
        'area'   => $area,
        'type'   => $type
    ]) ?>

</div>

</div>
