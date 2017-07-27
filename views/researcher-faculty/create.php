<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResearcherFaculty */

$this->title = 'Create Researcher Faculty';
$this->params['breadcrumbs'][] = ['label' => 'Researcher Faculties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="researcher-faculty-create">


<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>
