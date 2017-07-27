<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResearcherInstitution */

$this->title = 'Create Researcher Institution';
$this->params['breadcrumbs'][] = ['label' => 'Researcher Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="researcher-institution-create">


<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>
