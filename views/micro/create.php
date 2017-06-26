<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Micro */

$this->title = 'Create Micro';
$this->params['breadcrumbs'][] = ['label' => 'Micro', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="micro-create">

	<h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'micro' => $micro,
		'type'  => $type,
		'zone'  => $zone,
    ]) ?>

</div>
