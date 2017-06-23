<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchZone */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Research Zones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-zone-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Back',[ 'research-zone/'], ['class' => 'btn bg-navy']) ?>

        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

            <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'zone_id',
            'zone_name',
            'province_id',
            'amphur_id',
            'district_id',
            'region_id',
            'img_id',
            'information',
            'update_date',
            'created_by',
            'created_date',
            'update_by',
        ],
    ]) ?>
</div>
</div>
</div>
