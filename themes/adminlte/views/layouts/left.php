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

                <a href="#"><i class="fa fa-circle text-success"></i> offline</a>
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
                        'label' => 'หน้าแรก', 'icon' => 'home', 'url' => '@web/admin'
                    ],
                    [
                        'label' => 'ข้อมูลนักวิจัย',
                        'icon' => 'user',
                        'url' => ['/researcher'],
                        'active' => MenuHelper::Active('researcher')
                    ],
                    [
            		    'label' => 'ผลงานวิจัย',
            		    'icon' => 'folder',
            		    'url' => '#',
            		    'items' => [
                      [
                        'label' => 'ข้อมูลพื้นที่วิจัย',
            				    'icon' => 'info-circle',
            				    'url' => ['/research-area-information/index'],
                        'active' => MenuHelper::Active('research-area-information')
                      ],

            		    ],
            	    ],

                  [
                  'label' => 'ข้อมูลทรัพยากร',
                  'icon' => 'folder',
                  'url' => '#',
                  'items' => [
                    [
                      'label' => 'ข้อมูลพืช',
                      'icon' => 'info-circle',
                      'url' => ['/resource-plant/index-admin'],
                      'active' => MenuHelper::Active('resource-plant')
                    ],
                    [
                      'label' => 'ข้อมูลสัตว์และแมลง',
                      'icon' => 'info-circle',
                      'url' => ['/resource-animal/index-admin'],
                      'active' => MenuHelper::Active('resource-animal')
                    ],
                    [
                      'label' => 'ข้อมูลจุลินทรีย์',
                      'icon' => 'info-circle',
                      'url' => ['/resource-micrology/index-admin'],
                      'active' => MenuHelper::Active('resource-micrology')
                    ],

                  ],
                ],

                    [
            		    'label' => 'โครงงานวิจัย',
            		    'icon' => 'folder',
            		    'url' => '#',
            		    'items' => [
                      [
                        'label' => 'งานด้านนิเวศวิทยาและชุมชน',
            				    'icon' => 'info-circle',
            				    'url' => ['/project-ecology/index-admin'],
                        'active' => MenuHelper::Active('project-ecology')
                      ],
                      [
            				    'label' => 'พืชอนุรักษ์ยางนา',
            				    'icon' => 'info-circle',
            				    'url' => ['/project-garjan/index-admin'],
                        'active' => MenuHelper::Active('project-garjan')
            			    ],
            		    ],
            	    ],
                    ['label' => 'Login', 'url' => ['user/security/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        )?>
    </section>
</aside>
