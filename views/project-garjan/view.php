<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResourcePlant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Project Garjan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('<?=Url::to(['/themes/frontend/img/hibiscus-sabdariffa.jpg'])?>')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1><?php echo $model->name; ?></h1>
                        <h2 class="subheading">
                            <?php
                                function cutStr($str, $maxChars='', $holder=''){
                                    if (strlen($str) > $maxChars ){
                                        $str = iconv_substr($str, 0, $maxChars,"UTF-8") . $holder;
                                    }
                                        return $str;
                                    }
                                echo cutStr($model->summary, '100', '...');
                            ?></h2>
                        <span class="meta"><?php echo 'โพสต์โดย ' . $updated_by->username . ' ล่าสุดเมื่อวันที่ '. $model->updated_date?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- <nav class="navbar navbar-light" style="background-color: #8B0BE1;">
    <marquee direction="left"><font color="#ffff33"><B><h4> โครงการอนุรักษ์พันธุกรรมพืชอันเนื่องมาจากพระราชดำริ
    ฐานข้อมูลการดำเนินงานหน่วยงานร่วมสนองพระราชดำริฯ<h4><B></font></marquee>
    <div class="collapse navbar-collapse" id="navbarColor01">
    </div>
    </nav> -->

    <style>
      body {
            background-color: #d0ccc6c4;
      }
      </style>
    <article>
        <div class="container">
          <br>
          <div class="well">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h2 class="section-heading">ชื่อโครงการวิจัย</h2>
                    <p><?php echo $model->name; ?></p>

                    <h2 class="section-heading">สรุปผลงานวิจัย</h2>
                    <p><?php echo $model->summary; ?></p>



                    <!--p>Placeholder text by <a href="http://spaceipsum.com/">Space Ipsum</a>. Photographs by <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>.</p-->
                    <div class="center">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <?php foreach ($attach_files as $image): ?>
                                <?= Html::img('@web/uploads/files/'.$image->name,['class'=>'img-thumbnail center']);?>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
