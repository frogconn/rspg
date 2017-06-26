<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResearchZone */

$this->title = 'Create Research Zone';
$this->params['breadcrumbs'][] = ['label' => 'Research Zones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-zone-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'zone' => $zone,
        'province' => $province,
        'amphur' => $amphur,
        'district' => $district,
        'researchZone' => $researchZone,
        'amphur_list' => $amphur_list,
        'district_list' => $district_list
    ]) ?>

</div>
