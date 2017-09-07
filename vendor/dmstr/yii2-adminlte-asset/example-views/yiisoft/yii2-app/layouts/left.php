<?php 
use app\models\UserrolesModel;
use app\modules\nursinghomes\models\Nursinghomes;
use app\modules\doctors\models\Doctors;
use common\models\User;
use app\models\AdminInformation;
use yii\helpers\Url;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
           
            <?php 
             $roleiddata = User::find()->select(['role'])->where(['role'=> Yii::$app->user->identity->role])->one();
             $nursingimage = Nursinghomes::find()->select(['nursingImage'])->where(['nuserId'=>Yii::$app->user->identity->id])->one();
             $doctorimage = Doctors::find()->select(['doctorImage'])->where(['userId'=>Yii::$app->user->identity->id])->one();
             $userimage = AdminInformation::find()->select(['profileImage'])->where(['aduserId'=>Yii::$app->user->identity->id])->one();
            
             if($roleiddata['role'] ==1)
             	{
             		?>
             		<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="images" alt="User Image"/>
             		<?php
             	}
             else
             {
             	if ($nursingimage['nursingImage'] != '' || $doctorimage['doctorImage'] != '' || $userimage['profileImage'] != '' )
             	{
             		 if($roleiddata['role'] == 3)
					   {
					   		?>
					   	 		 <img src="<?= $nursingimage['nursingImage'] ?>" class="images" alt="Image"/>
               
					  		<?php  
					   }
					  elseif ($roleiddata['role'] == 2)
					  {
					  	?>
					  	 <img src="<?= $doctorimage['doctorImage'] ?>" class="images" alt="Image"/>					  	
					  	<?php 
					  	
					  }
					  elseif ($roleiddata['role'] >= 4)
					  {
					  	
					  	?>
					 	<img src="<?= $userimage['profileImage'] ?>" class="images" alt="Image"/>					  	
					  	<?php 
					  }
             	}
					  else 
					  {
					  	?>
					  	<img src="<?php echo Url::base()."/images/user-iconnew.png" ;?>"class="images" alt="Image"> </img>
					  	<?php 
					  	
					  }
             }?>
                
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username;?></p>
            

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
<?php if(UserrolesModel::getRole() == 2){

	?>
 <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    /* ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest], */
                		
                    [
                        'label' => 'Doctors',
                    	//'class' => 'fa fa-user-md',
                        'icon' => 'user-md',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Profile', 'icon' => 'plus-circle', 'url' => ['/doctors/doctors/profileview','uid'=>Yii::$app->user->identity->id],],
                            ['label' => 'Profile Update', 'icon' => 'eye', 'url' => ['/doctors/doctors/profileupdate','uid'=>Yii::$app->user->identity->id],],
                        	['label' => 'Slots', 'icon' => 'eye', 'url' => ['/doctors/doctors/slots'],],
                            ['label' => 'Patient Requests', 'icon' => 'eye', 'url' => ['/doctors/doctors/patient-requests'],],
                        	['label' => 'Completed Requests', 'icon' => 'eye', 'url' => ['/doctors/doctors/patient-requests-completed'],],
                        	['label' => 'Nursing Homes List', 'icon' => 'eye', 'url' => ['/doctors/doctors/nghlist'],],
                            
                        ],
                    ],
                		
                		
                ],
            ]
        ) ?>
<?php }elseif (UserrolesModel::getRole() == 3){?>

<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    /* ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest], */
                		
                		[
                		'label' => 'Nursing Homes',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'h-square',
                		'url' => '#',
                		'items' => [
                				['label' => 'Profile', 'icon' => 'plus-circle', 'url' => ['/nursinghomes/nursinghomes/profileview','uid'=>Yii::$app->user->identity->id],],
                				['label' => 'Profile Update', 'icon' => 'eye', 'url' => ['/nursinghomes/nursinghomes/profileupdate','uid'=>Yii::$app->user->identity->id],],
                				['label' => 'Doctors specialities List', 'icon' => 'eye', 'url' => ['/nursinghomes/nursinghomes/doctorspecialitieslist'],],
                				
                		],
                		],
                		
                		[
                		'label' => 'Patients',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'user',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/patients/patients/patientshistorycreate'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/patients/patients'],],
                			/* ['label' => 'History Create', 'icon' => 'plus-circle', 'url' => ['/patients/patients/patientshistorycreate'],], */
                		
                		],
                		],
                		
                ],
            ]
        ) ?>

<?php } elseif (UserrolesModel::getRole() == 1){?>

<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    /* ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest], */
                		[
                		'label' => 'Roles',
                		'icon' => 'user-secret',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/role/roles/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/role/roles/index'],],
                		],
                		
                		],
                		[
                		'label' => 'Admin Users',
                		'icon' => 'user',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/user/adminusers/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/user/adminusers/index'],],
                		],
                		
                		],
                		[
                				'label' => 'Modules',
                				'icon' => 'users',
                				'url' => '#',
                				'items' => [
                						['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/user/modulemaster/create'],],
                						['label' => 'View All', 'icon' => 'eye', 'url' => ['/user/modulemaster/index'],],
                				],
                		
                		],
                    [
                        'label' => 'Doctors',
                    	//'class' => 'fa fa-user-md',
                        'icon' => 'user-md',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/doctors/doctors/create'],],
                            ['label' => 'View All', 'icon' => 'eye', 'url' => ['/doctors/doctors'],],
                            
                        ],
                    ],
                		[
                		'label' => 'Interested Doctors',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'user-md',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/intresteddoctors/intresteddoctors/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/intresteddoctors/intresteddoctors'],],
                		
                		],
                		],
                		[
                		'label' => 'Qualifications',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'sun-o',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/qualifications/qualifications/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/qualifications/qualifications'],],
                		
                		],
                		],
                		[
                		'label' => 'Speicialities',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'id-badge',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/specialities/specialities/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/specialities/specialities'],],
                		
                		],
                		],
                		[
                		'label' => 'Nursing Homes',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'h-square',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/nursinghomes/nursinghomes/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/nursinghomes/nursinghomes'],],
                		
                		],
                		],
                		[
                		'label' => 'Intrested Nursing Homes',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'h-square',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/intrestednursinghomes/intrestednghs/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/intrestednursinghomes/intrestednghs'],],
                		
                		],
                		],
                		
                		
                ],
            ]
        ) ?>

<?php }else{?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],
                    /* ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest], */
                		
                		[
                		'label' => 'Admin Users',
                		'icon' => 'user',
                		'url' => '#',
                		'items' => [
                				
                				['label' => 'ProfileView', 'icon' => 'plus-circle', 'url' => ['/user/adminusers/profileview','id'=>Yii::$app->user->identity->id],],
                				['label' => 'Profile Update', 'icon' => 'eye', 'url' => ['/user/adminusers/profileupdate','id'=>Yii::$app->user->identity->id],],
                		],
                		
                		],
                		
                		[
                		'label' => 'Doctors',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'user-md',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/doctors/doctors/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/doctors/doctors'],],
                		
                		],
                		],
                		[
                		'label' => 'Interested Doctors',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'user-md',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/intresteddoctors/intresteddoctors/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/intresteddoctors/intresteddoctors'],],
                		
                		],
                		],
                		[
                		'label' => 'Qualifications',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'sun-o',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/qualifications/qualifications/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/qualifications/qualifications'],],
                		
                		],
                		],
                		[
                		'label' => 'Speicialities',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'id-badge',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/specialities/specialities/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/specialities/specialities'],],
                		
                		],
                		],
                		[
                		'label' => 'Nursing Homes',
                		//'class' => 'fa fa-user-md',
                		'icon' => 'h-square',
                		'url' => '#',
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/nursinghomes/nursinghomes/create'],],
                				['label' => 'View All', 'icon' => 'eye', 'url' => ['/nursinghomes/nursinghomes'],],
                		
                		],
                		],
                		[
                				'label' => 'Intrested Nursing Homes',
                				//'class' => 'fa fa-user-md',
                				'icon' => 'h-square',
                				'url' => '#',
                				'items' => [
                						['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/intrestednursinghomes/intrestednghs/create'],],
                						['label' => 'View All', 'icon' => 'eye', 'url' => ['/intrestednursinghomes/intrestednghs'],],
                		
                				],
                		],
                		
                		
                		
                ],
            ]
        ) ?>
        <?php } ?>

    </section>

</aside>
<style>
.images{
    width: 25px;
    height: 25px;
    border-radius: 50%;
    margin-right: 10px;
    margin-top: -2px;
}
.user-panel>.image>img {
   max-width:45px;
   height:45px;
    }

</style>