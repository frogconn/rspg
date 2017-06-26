<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Animal */

$this->title = 'Update Animal: ' . $animal->com_name;
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $animal->animal_id, 'url' => ['view', 'id' => $animal->animal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="animal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'animal' => $animal,
        'zone' => $zone,
        'type' => $type
    ]) ?>

</div>
