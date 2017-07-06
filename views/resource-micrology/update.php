<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceMicrology */

$this->title = '' . $micro->genus;
$this->params['breadcrumbs'][] = ['label' => 'Resource Micrologies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $micro->id, 'url' => ['view', 'id' => $micro->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resource-micrology-update">

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

    <?= $this->render('_form', [
        'micro' => $micro,
        'type'  => $type,
        'area'  => $area, 
    ]) ?>

</div>
</div>
