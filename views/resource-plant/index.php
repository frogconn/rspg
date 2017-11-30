<?php
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
?>
<div class='resource-plant-index'>
    <!-- Page Header -->
            <!-- Set your background image for this header on the line below. -->
            <header class="intro-header" style="background-image: url('<?=Url::to(['/themes/frontend/img/home-bg.jpg'])?>')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <div class="site-heading">
                                <span style='white-space: pre;'><h2>โครงการอนุรักษ์พันธุกรรมพืชอันเนื่องมาจากพระราชดำริ</h2></span>
                                <hr class="small">
                                <span class="subheading">ฐานข้อมูลการดำเนินงานหน่วยงานร่วมสนองพระราชดำริฯ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
  <div class="well">
    <table class="table table-bordered">
      <div class="row">
    <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'itemOptions' => [
                'class' => 'col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1'
            ],
        ]);
    ?>
</div>
