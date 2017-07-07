<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use yii\widgets\DetailView;
use yii\base\Controller;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectEcology */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Project Ecologies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-ecology-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Back',[ 'project-ecology/'], ['class' => 'btn bg-navy']) ?>

        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('Create Continue',[ 'project-ecology/create'], ['class' => 'btn bg-green']) ?>
    </p>

      <div class="box box-success">
            <!-- class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'projectType.type',
            'year',
            'name',
            [
                'label'=>'ผู้ร่วมโครงการ',
                'format'=>'raw',
                'value'=>Yii::$app->controller->renderPartial('_partitions', array('model'=>$model), true),
            ],
            'budget',
<<<<<<< HEAD:views/project-ecology/view.php
=======
            'type_id',
>>>>>>> 32166677218cc90a151bd949d0e1180b2f71b497:views/project-garjan/view.php
            'summary:ntext',
            'start',
            'stop',

            //'type_id',
            //'created_by',
            //'created_date',
            //'updated_by',
            //'updated_date',
        ],
    ]) ?>
</div>
</div>
</div>
