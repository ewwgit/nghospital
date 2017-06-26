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
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    /* ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest], */
                		[
                		'label' => 'Roles',
                		'icon' => 'fa fa-user-secret',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'fa fa-plus', 'url' => ['/role/roles/create'],],
                				['label' => 'View All', 'icon' => 'fa fa-eye', 'url' => ['/role/roles/index'],],
                		],
                		
                		],
                		[
                		'label' => 'Admin Users',
                		'icon' => 'fa fa-users',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'fa fa-plus', 'url' => ['/user/adminusers/create'],],
                				['label' => 'View All', 'icon' => 'fa fa-eye', 'url' => ['/user/adminusers/index'],],
                		],
                		
                		],
                		[
                				'label' => 'Modules',
                				'icon' => 'fa fa-users',
                				'url' => '#',
                				'items' => [
                						['label' => 'Create', 'icon' => 'fa fa-plus', 'url' => ['/user/modulemaster/create'],],
                						['label' => 'View All', 'icon' => 'fa fa-eye', 'url' => ['/user/modulemaster/index'],],
                				],
                		
                		],
                    [
                        'label' => 'Doctors',
                    	//'class' => 'fa fa-user-md',
                        'icon' => 'user-md',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Create', 'icon' => 'circle-o', 'url' => ['/doctors/doctors/create'],],
                            ['label' => 'View', 'icon' => 'circle-o', 'url' => ['/doctors/doctors'],],
                            
                        ],
                    ],
                		[
                		'label' => 'Qualifications',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'sun-o',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'circle-o', 'url' => ['/qualifications/qualifications/create'],],
                				['label' => 'View', 'icon' => 'circle-o', 'url' => ['/qualifications/qualifications'],],
                		
                		],
                		],
                		[
                		'label' => 'Speicialities',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'id-badge',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'circle-o', 'url' => ['/specialities/specialities/create'],],
                				['label' => 'View', 'icon' => 'circle-o', 'url' => ['/specialities/specialities'],],
                		
                		],
                		],
                		[
                		'label' => 'Nursing Homes',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'h-square',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'circle-o', 'url' => ['/nursinghomes/nursinghomes/create'],],
                				['label' => 'View', 'icon' => 'circle-o', 'url' => ['/nursinghomes/nursinghomes'],],
                		
                		],
                		],
                		[
                		'label' => 'Interested Doctors',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'user-md',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'circle-o', 'url' => ['/intresteddoctors/intresteddoctors/create'],],
                				['label' => 'View', 'icon' => 'circle-o', 'url' => ['/intresteddoctors/intresteddoctors'],],
                		
                		],
                		],
                ],
            ]
        ) ?>

    </section>

</aside>
