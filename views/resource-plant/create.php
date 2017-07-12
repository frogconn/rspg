<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResourcePlant */

$this->title = 'สร้างทรัพยากรพืชใหม่';
$this->params['breadcrumbs'][] = ['label' => 'ทรัพยากรพืช', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-plant-create">


<div class="box box-success">
            <div class="box-header with-border">
              <!--h3 class="box-title"--><!--?= Html::encode($this->title) ?--></h3>
            </div>

    <?= $this->render('_form', [
         'plant' => $plant,
         'type'  => $type,
         'researchArea' => $researchArea
    ]) ?>

</div>

</div>
