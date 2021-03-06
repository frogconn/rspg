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

                <a href="#"><i class="fa fa-circle text-success"></i> online</a>
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
            				    'icon' => 'file-image-o',
            				    'url' => '@web/research-area-information',
                            ],
                            [
            				    'label' => 'ทรัพยากร',
            				    'icon' => 'share',
            				    'url' => '#',
            				    'items' => [
            					    ['label' => 'ข้อมูลพืช', 'icon' => 'circle-o', 'url' => ['/resource-plant/index-admin']],
            			    	    ['label' => 'ข้อมูลสัตว์และแมลง', 'icon' => 'circle-o', 'url' => ['/resource-animal/index-admin']],
            					    ['label' => 'ข้อมูลจุลินทรีย์', 'icon' => 'circle-o', 'url' => ['/resource-micrology/index-admin']],
            				    ],
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
            				    'icon' => 'handshake-o',
            				    'url' => '@web/project-ecology/index-admin',
                            ],
                            [
            				    'label' => 'พืชอนุรักษ์ยางนา',
            				    'icon' => 'leaf',
            				    'url' => '@web/project-garjan/index-admin',
            				
            			    ],
            		    ],
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
        )?>
    </section>
</aside>