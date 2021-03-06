<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformation */

$this->title = $researchArea->name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นที่วิจัย', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = ['label' => $researchArea->name, 'url' => ['view', 'id' => $information->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="research-area-information-update">

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

    <?= $this->render('_form', [
        'information' => $information,
		'researchArea' => $researchArea,
		'province' => $province,
		'amphur' => $amphur,
		'district' => $district,
		'amphur_list' => $amphur_list,
		'district_list' => $district_list,
    ]) ?>

</div>
</div>
