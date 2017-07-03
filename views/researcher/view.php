<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Researcher */

$this->title = $model->title.$model->firstname_th." ".$model->lastname_th;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลนักวิจัย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="researcher-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Back',[ 'researcher/'], ['class' => 'btn bg-navy']) ?>

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
            'personal_code',
            'isForeigner',
            'title',
            'firstname_th',
            'lastname_th',
            'firstname_en',
            'lastname_en',
            'fullname_th',
            'fullname_en',
            'gGender',
            'email:email',
            'telephone',
           [
            'format'=>'raw',
            'attribute'=>'evidence_file',
            'value'=>Html::img($model->photoViewer,['class'=>'img-thumbnail','style'=>'width:200px;'])
            ],
            'created_date',
            'created_by',
            'updated_date',
            'updated_by',
        ],
    ]) ?>
</div>
</div>
</div>
