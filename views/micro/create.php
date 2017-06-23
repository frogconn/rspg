<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'Create Micro';
$this->params['breadcrumbs'][] = ['label' => 'Micro', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">


<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'micro' => $micro,
		'type'  => $type,
		'zone'  => $zone
    ]) ?>

</div>

</div>
