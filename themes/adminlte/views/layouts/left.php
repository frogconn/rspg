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
                ['label' => 'หน้าหลัก', 'icon' => 'home', 'url' => '@web'],
                [
                  'label' => 'ข้อมูลนักวิจัย',
                  'icon' => 'user',
                  'url' => ['/researcher'],
                  'active' => MenuHelper::Active('researcher')
                ],
                [
            		'label' => 'ตั้งค่าผู้ใช้งาน',
            		'icon' => 'cog',
            		'url' => '#',
            		'items' => [
                        [
            				'label' => 'จัดการสิทธิ์',
            				'icon' => 'share',
            				'url' => '#',
            				'items' => [
            					['label' => 'Assignments', 'icon' => 'fa fa-caret-right', 'url' => ['/admin/assignment']],
            			    	['label' => 'Role', 'icon' => 'fa fa-caret-right', 'url' => ['/admin/role']],
            					['label' => 'Permission', 'icon' => 'fa fa-caret-right', 'url' => ['/admin/permission']],
            				    ['label' => 'Route', 'icon' => 'fa fa-caret-right', 'url' => ['/admin/route']],
            					['label' => 'Rule', 'icon' => 'fa fa-caret-right', 'url' => ['/admin/rule']],
            				],
            			],
            		],
            	],
                ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                ['label' => 'Login', 'url' => ['user/security/login'], 'visible' => Yii::$app->user->isGuest],
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
    )   
        ?>
    </section>
</aside>