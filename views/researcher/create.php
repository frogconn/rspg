<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Researcher */

$this->title = 'สร้างข้อมูลนักวิจัยใหม่'; // English
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลนักวิจัย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="researcher-create">


<div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

    <?= $this->render('_form', [
        'model' => $model,
        'instit' => $instit,
        'faculty' => $faculty,
        'faculty_list' => $faculty_list,
        'agency'=>$agency,
    ]) ?>

</div>

</div>
