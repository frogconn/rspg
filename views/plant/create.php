<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Plant */

$this->title = 'Create Plant';
$this->params['breadcrumbs'][] = ['label' => 'Plant', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'zone' => $zone,
		'type' => $type
    ]) ?>

</div>
