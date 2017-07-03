<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformation */

$this->title = 'Create Research Area Information';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นที่วิจัย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-area-information-create">


<div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

    <?= $this->render('_form', [
    		'researchArea'	=> $researchArea,
         	'provinceid'    => $provinceid, 
            'amphurid'      => $amphurid,
            'districtid'    => $districtid,
            //'regionid'      => $regionid,
            'information'   => $information,
    ]) ?>

</div>

</div>
