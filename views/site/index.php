<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;



/* @var $this yii\web\View */

$this->title = ' ';
?>
<div class="site-view">
	<div>
	<p><center>
    <h1>
		โครงการอนุรักษ์พันธุกรรมพืชอันเนื่องมาจากพระราชดำริ<br>
		สมเด็จพระเทพรัตนราชสุดาฯ สยามบรมราชกุมารี(อพ.สธ.)<br>
	</h1>
    <?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:150px;']);?>
    <h2>
		ฐานข้อมูล<br>
		การดำเนินงานหน่วยงานร่วมสนองพระราชดำริฯ
	</h2>
	</p></center>
	</div>


	<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="x_panel">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">ผลงานวิจัย</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<ul class="products-list product-list-in-box">
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('ข้อมูลพื้นที่วิจัย', ['/research-area-information'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('ข้อมูลพืช', ['/resource-plant'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('ข้อมูลสัตว์และแมลง', ['/resource-animal'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('ข้อมูลจุลินทรีย์', ['/resource-micrology'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
			</ul>
		</div>
		<!-- /.box-body -->
		<!--div class="box-footer text-center">
		<a href="javascript:void(0)" class="uppercase">View All Products</a>
		</di-->
		<!-- /.box-footer -->
	</div></div></div>

<div class="clearfix"></div>

</div>
