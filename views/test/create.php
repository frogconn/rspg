<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'Create Test';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">


<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>
