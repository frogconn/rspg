<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformation */

$this->title = 'สร้างข้อมูลพื้นที่วิจัยใหม่';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นที่วิจัย', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-area-information-create">


<div class="box box-success">
            <div class="box-header with-border">
              <!--h3 class="box-title"--><!--?= Html::encode($this->title) ?--></h3>
            </div>

    <?= $this->render('_form', [
    		'researchArea'	=> $researchArea,
        'province'      => $province, 
        'amphur'        => $amphur,
        'district'      => $district,
        'information'   => $information,
			  'amphur_list'   => $amphur_list,
			  'district_list' => $district_list,
    ]) ?>

</div>

</div>
