<?php
use yii\helpers\Html;
use yii\helpers\Url;

use app\assets\FrontendAsset;
use app\assets\AppAsset;


/* @var $this \yii\web\View */
/* @var $content string */

//AppAsset::register($this);
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
        <link rel="stylesheet" href="style.css" />
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
                    <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl;?>">RSPG</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo Yii::$app->homeUrl;?>">หน้าหลัก</a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                aria-haspopup="true" aria-expanded="false">ข้อมูลทรัพยากร
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo Url::base().'/resource-plant'; ?>">ทรัพยากรพืช</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo Url::base().'/resource-animal'; ?>">ทรัพยากรสัตว์</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo Url::base().'/resource-micrology'; ?>">ทรัพยากรจุลินทรีย์</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown">โครงการวิจัย
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo Url::base().'/project-ecology'; ?>">โครงการวิจัยนิเวศและชุมชน</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo Url::base().'/project-garjan'; ?>">โครงการวิจัยยางนา</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="admin">ติดต่อเรา</a>
                        </li>
                        <li>
                            <?php if (Yii::$app->user->isGuest){ ?>
                            <a href="<?php echo Url::base().'/user/security/login'; ?>">เข้าสู่ระบบ</a>
                            <?php }else{ ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"> <?php echo Yii::$app->session['username']; ?>
                                    <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="admin">โครงงานวิจัย</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?=Url::to('user/security/logout')?>" data-method="post">ออกจากระบบ</a></li>
                                    </ul>
                                </li>
                            <?php } ?>

                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                </div>
            <!-- /.container -->
            </nav>
            
            <?= $content ?>
        </div>>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

