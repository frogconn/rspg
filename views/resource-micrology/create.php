<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResourceMicrology */

$this->title = 'สร้างทรัพยากรจุลินทรีย์ใหม่';
$this->params['breadcrumbs'][] = ['label' => 'ทรัพยากรจุลินทรีย์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-micrology-create">


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
