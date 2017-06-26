<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchZone */

$this->title = 'Update Research Zone: ' . $zone->zone_name;
$this->params['breadcrumbs'][] = ['label' => 'Research Zones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $zone->zone_id, 'url' => ['view', 'id' => $zone->zone_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="research-zone-update">

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
