<?php
use yii\helpers\Html;
use app\assets\FrontendAsset;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */


FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition <?= \dmstr\helpers\AdminLteHelper::skinClass() ?> sidebar-mini">
        <?php $this->beginBody() ?>
            <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="index.php">RSPG</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="index.php">หน้าหลัก</a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                aria-haspopup="true" aria-expanded="false">ข้อมูลทรัพยากร
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="resource-plant/">ทรัพยากรพืช</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">ทรัพยากรสัตว์</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">ทรัพยากรจุลินทรีย์</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown">โครงการวิจัย
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">โครงการวิจัยนิเวศและชุมชน</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">โครงการวิจัยยางนา</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="contact.html">ติดต่อเรา</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                </div>
            <!-- /.container -->
            </nav>
            
            <?= $content ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

