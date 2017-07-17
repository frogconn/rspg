<?php
use app\assets\AppAsset;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

AppAsset::register($this);


/* @var $this yii\web\View */
?>
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
<hr>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview">
                    <h1 class="post-title">
                        ข้อมูลทรัพยากร
                    </h1>
                    <h3 class="post-subtitle">
                        <a href="resource-plant/">ทรัพยากรพืช</a> 
                        <a href="#">ทรัพยากรสัตว์และแมลง</a> 
                        <a href="#">ทรัพยากรจุลินทรีย์</a>
                    </h3>
                <p class="post-meta">Posted by <a href="#">RSPG</a> on September 24, 2014</p>
            </div>
            <hr>
            <div class="post-preview">
                    <h1 class="post-title">
                        ข้อมูลโครงการวิจัย
                    </h1>
                    <h3 class="post-subtitle">
                        <a href="#">โครงการวิจัยนิเวศวิทยาและชุมชน</a> 
                        <a href="#">โครงการวิจัยยางนา</a> 
                    </h3>
                <p class="post-meta">Posted by <a href="#">RSPG</a> on September 18, 2014</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        สวนพฤกษศาสตร์โรงเรียน
                    </h2>
                </a>
                <p class="post-meta">Posted by <a href="#">RSPG</a> on August 24, 2014</p>
            </div>
            <hr>
        </div>
    </div>
</div>