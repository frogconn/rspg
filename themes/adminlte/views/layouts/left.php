<?php
use app\components\MenuHelper;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                      'label' => 'ลงทะเบียนนักวิจัย',
                      'icon' => 'file-car',
                      'url' => ['/researcher'],
                      'active' => MenuHelper::Active('researcher')
                    ],
					[
                      'label' => 'ข้อมูลพื้นที่วิจัย',
                      'icon' => 'file-car',
                      'url' => ['/research-zone'],
                      'active' => MenuHelper::Active('research-zone')
                    ],
					//
					[
                        'label' => 'ข้อมูลผลงานวิจัย',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'ข้อมูลพื้นที่วิจัย', 'icon' => 'file-code-o', 'url' => ['/research-zone'],],
                            [
                                'label' => 'ข้อมูลทรัพยากร',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'พืช', 'icon' => 'circle-o', 'url' => '#',],
									['label' => 'สัตว์และแมลง', 'icon' => 'circle-o', 'url' => '#',],
									['label' => 'จุลินทรีย์', 'icon' => 'circle-o', 'url' => '#',],
                                    /*[
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],*/
                                ],
                            ],
							['label' => 'งานด้านนิเวศวิทยาและชุมชน', 'icon' => 'dashboard', 'url' => ['/debug'],],
							                            [
                                'label' => 'พืชอนุรักษ์ยางนา',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'กรอบการเรียนรู้', 'icon' => 'circle-o', 'url' => '#',],
									['label' => 'กรอบการใช้ประโยชน์', 'icon' => 'circle-o', 'url' => '#',],
									['label' => 'กรอบการสร้างจิตสำนึก', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],
                        ],
                    ],
					//
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
