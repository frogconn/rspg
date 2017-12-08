
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResourcePlant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Resource Plants', 'url' => ['index']];
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
                                echo cutStr($model->personal_code, '100', '...');
                            ?></h2>
                        <span class="meta"><?php echo 'โพสต์โดย ' . $updated_by->username . ' ล่าสุดเมื่อวันที่ '. $model->updated_date?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <article>
        <div class="container">
          <br>
            <br>
          <div class="well">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <!--h2 class="section-heading">ประเภท</h2-->
                    <!--p><?php echo $model->type_id; ?></p-->

                    <!--h2 class="section-heading">ปีงบประมาณ</h2-->
                    <!--p><?php echo $model->year; ?></p-->

                    <h2 class="section-heading">ชื่อโครงการวิจัย</h2>
                    <p><?php echo $model->name; ?></p>

                    <!--h2 class="section-heading">หัวหน้าโครงการวิจัย</h2-->
                    <!--p><?php echo $model->personal_code; ?></p-->

                    <!--h2 class="section-heading">งบประมาณ</h2-->
                    <!--p><?php echo $model->budget; ?></p-->

                    <!--blockquote>The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</blockquote-->

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
