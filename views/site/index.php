<?php
use app\assets\AppAsset;
use app\assets\FrontendAsset;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

//Asset::register($this);
FrontendAsset::register($this);

/* @var $this yii\web\View */
?>
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('<?=Url::to(['/themes/frontend/img/home-bg.jpg'])?>')">
    <div class="article-body">
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
      <nav class="navbar navbar-light" style="background-color: #8B0BE1;line-height: 15px;height: 40px;padding-top: 5px;">
      <marquee direction="left"><font color="#ffff33"><B><h4> โครงการอนุรักษ์พันธุกรรมพืชอันเนื่องมาจากพระราชดำริ
      ฐานข้อมูลการดำเนินงานหน่วยงานร่วมสนองพระราชดำริฯ<h4><B></font></marquee>
      <div class="collapse navbar-collapse" id="navbarColor01">
      </div>
      </nav>
          <style>
body {
    background-color: #AF34DC;
}
</style>
<!--  <style>body{background-image:url('<?=Url::to(['/themes/frontend/img/damask.jpg'])?>');}</style>-->
  <div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="well">
                    <h1 class="post-title">
                        ข้อมูลทรัพยากร
                    </h1>
                    <h3 class="post-subtitle">
                        <a href="resource-plant/">ทรัพยากรพืช</a>
                        <a href="resource-animal/">ทรัพยากรสัตว์และแมลง</a>
                        <a href="resource-micrology">ทรัพยากรจุลินทรีย์</a>
                    </h3>
                <p class="post-meta">Posted by <a href="#">RSPG</a> on September 24, 2014</p>
            </div>
            <hr>
            <div class="well">
                    <h1 class="post-title">
                        ข้อมูลโครงการวิจัย
                    </h1>
                    <h3 class="post-subtitle">
                        <a href="project-ecology/">โครงการวิจัยนิเวศวิทยาและชุมชน</a>
                        <a href="project-garjan/">โครงการวิจัยยางนา</a>
                    </h3>
                <p class="post-meta">Posted by <a href="#">RSPG</a> on September 18, 2014</p>
            </div>
            <hr>
            <div class="well">
                <a href="post.html">
                    <h2 class="post-title">
                        <a href="#">สวนพฤกษศาสตร์โรงเรียน</a>
                    </h2>
                </a>
                <p class="post-meta">Posted by <a href="#">RSPG</a> on August 24, 2014</p>
            </div>
            <hr>
        </div>
    </div>
</div>
