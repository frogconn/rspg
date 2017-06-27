<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Animal */

$this->title = $model->com_name;
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Back',[ 'animal/'], ['class' => 'btn bg-navy']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->animal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->animal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'animal_id',
            ['attribute'=>'type_name','value'=>$model->type->type_name],
            'com_name',
            'loc_name',
            'sc_name',
            'fam_name',
            'gen_info:ntext',
            //'zone_id',
            ['attribute'=>'zone_name','value'=>$model->zone->zone_name],
            'banefit:ntext',
            //'img_code',
            //'type_id',
            //'update_date',
            //'created_by',
            //'created_date',
            //'update_by',
        ],
    ]) ?>

</div>
