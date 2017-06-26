<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Micro */

$this->title = 'Update Micro: ' . $micro->mic_id;
$this->params['breadcrumbs'][] = ['label' => 'Micros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $micro->mic_id, 'url' => ['view', 'id' => $micro->mic_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="micro-update">
 <h1><?= Html::encode($this->title) ?></h1>
		
		
		<?= $this->render('_form', [
        'micro' => $micro,
		'type'  => $type,
		'zone'  => $zone,
		]) ?>


</div>
