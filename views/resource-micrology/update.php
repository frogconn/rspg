<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceMicrology */

$this->title = $micro->genus;
$this->params['breadcrumbs'][] = ['label' => 'ทรัพยากรย์จุลินทรีย์', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = ['label' => $micro->genus, 'url' => ['view', 'id' => $micro->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="resource-micrology-update">

    <div class="box box-success">
            <div class="box-header with-border">
              <!--h3 class="box-title"--><!--?= Html::encode($this->title) ?--></h3>
            </div>

    <?= $this->render('_form', [
        'micro' => $micro,
        'type'  => $type,
        'area'  => $area, 
    ]) ?>

</div>
</div>
