<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformation */

$this->title = $information->id;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นที่วิจัย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $information->id, 'url' => ['view', 'id' => $information->id]];
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
		'provinceid' => $provinceid,
		'amphurid' => $amphurid,
		'districtid' => $districtid,
		'amphur_list' => $amphur_list,
		'district_list' => $district_list,
    ]) ?>

</div>
</div>
