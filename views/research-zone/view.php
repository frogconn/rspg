<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchZone */

$this->title = $model->zone_name;
$this->params['breadcrumbs'][] = ['label' => 'Research Zones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-zone-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Back',[ 'research-zone/'], ['class' => 'btn bg-navy']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->zone_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->zone_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
        echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'zone_name','value'=>$model->zone->zone_name],
            ['attribute'=>'d_name','value'=>$model->district->d_name],
            ['attribute'=>'a_name','value'=>$model->amphur->a_name],
            ['attribute'=>'p_name','value'=>$model->province->p_name],
            'gen_info'
        ],
    ]) ?>

</div>
