<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResearcherInstitution */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Researcher Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="researcher-institution-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Back',[ 'researcher-institution/'], ['class' => 'btn bg-navy']) ?>

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
            'name',
            'created_date',
            'created_by',
            'updated_date',
            'updated_by',
        ],
    ]) ?>
</div>
</div>
</div>
