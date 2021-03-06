<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;



/* @var $this yii\web\View */

$this->title = '';
?>
<div class="box box-success">
	<div>
	<div class="row">
        <div class="col-md-12">
		<p><center>
			<h1>โครงการอนุรักษ์พันธุกรรมพืชอันเนื่องมาจากพระราชดำริ<br></h1>
			<h2>สมเด็จพระเทพรัตนราชสุดาฯ สยามบรมราชกุมารี(อพ.สธ.)</h2>
			<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:150px;']);?>
			<h2>ฐานข้อมูลการดำเนินงานหน่วยงานร่วมสนองพระราชดำริฯ</h2>
		</center></p>
		<div class="chart">
            <!-- Sales Chart Canvas -->
			<canvas id="salesChart" style="height: 65px; width: 255px;" width="255" height="65"></canvas>
        </div></div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	</div>
	
	<div class="clearfix"></div>

	<div class="row">
	<div class="col-md-4">
	<div class="box box-success">
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
						<?= Html::a('ข้อมูลพื้นที่วิจัย', ['/research-area-information/index-admin'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('ข้อมูลพืช', ['/resource-plant/index-admin'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('ข้อมูลสัตว์และแมลง', ['/resource-animal/index-admin'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('ข้อมูลจุลินทรีย์', ['/resource-micrology/index-admin'], ['class' => 'profile-link']) ?>
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
	</div></div>
	
	<div class="row">
	<div class="col-md-4">
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">โครงงานวิจัย</h3>
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
						<?= Html::a('งานด้านนิเวศวิทยาและชุมชน', ['/project-ecology/index-admin'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('พืชอนุรักษ์ยางนา', ['/project-garjan/index-admin']) ?>
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
	</div></div>

<div class="row">
	<div class="col-md-3">
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">ข้อมูลทั่วไป</h3>
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
						<?= Html::a('ข้อมูลคณะ', ['/researcher-faculty'], ['class' => 'profile-link']) ?>
						<span class="product-description"></span>
					</div>
				</li>
				<!-- /.item -->
				<li class="item">
					<div class="product-img">
						<?= Html::img('img\none.png',['class'=>'img-thumbnail','style'=>'width:48px;height:48px']);?>
					</div>
					<div class="product-info">
						<?= Html::a('ข้อมูลมหาวิทยาลัย', ['/researcher-institution']) ?>
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
	</div></div>

	<div class="clearfix"></div>
</div>