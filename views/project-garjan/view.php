<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectGarjan */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Project Garjans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-garjan-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Back',[ 'project-garjan/'], ['class' => 'btn bg-navy']) ?>

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
            'year',
            'name',
            'personal_code',
            'faculty_id',
            'budget',
            'type_id',
            'summary:ntext',
            'start',
            'stop',
            'created_by',
            'created_date',
            'update_by',
            'update_date',
        ],
    ]) ?>
</div>
</div>
</div>
