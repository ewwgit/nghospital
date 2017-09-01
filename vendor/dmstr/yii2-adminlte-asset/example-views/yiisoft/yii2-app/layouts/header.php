<?php
use yii\helpers\Html;
use app\modules\nursinghomes\models\Nursinghomes;
use app\modules\doctors\models\Doctors;
use common\models\User;
use app\models\AdminInformation;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">NGH</span><span class="logo-lg">Nightingale Hospitals </span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

               

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
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
					   	 		 <img src="<?= $nursingimage['nursingImage'] ?>" class="user-image" alt="Image"/>
               
					  		<?php  
					   }
					  elseif ($roleiddata['role'] == 2)
					  {
					  	?>
					  	 <img src="<?= $doctorimage['doctorImage'] ?>" class="user-image" alt="Image"/>					  	
					  	<?php 
					  	
					  }
					  elseif ($roleiddata['role'] >= 4)
					  {
					  	
					  	?>
					 	<img src="<?= $userimage['profileImage'] ?>" class="user-image" alt="Image"/>					  	
					  	<?php 
					  }
             	}
					  else 
					  {
					  	?>
					  	<img class='images'
             				src="<?php
									 echo Url::base()."/images/user-iconnew.png" ;
							
								?>"
             width="100" height="100"> </img>
					  	<?php 
					  	
					  }
             }
             	?>
             	            
                       
                    <span class="hidden-xs"><?php echo Yii::$app->user->identity->username;?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                         <?php 
             $roleiddata = User::find()->select(['role'])->where(['role'=> Yii::$app->user->identity->role])->one();
             //$username=User::find()->select(['username'])->where(['username'=>Yii::$app->user->identity->username])->one();
             $nursingimage = Nursinghomes::find()->select(['nursingImage'])->where(['nuserId'=>Yii::$app->user->identity->id])->one();
             $doctorimage = Doctors::find()->select(['doctorImage'])->where(['userId'=>Yii::$app->user->identity->id])->one();
             $userimage = AdminInformation::find()->select(['profileImage'])->where(['aduserId'=>Yii::$app->user->identity->id])->one();
           
             
             	if($roleiddata['role'] ==1)
             	{
             		
             		?>
             		<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle images" alt="User Image"/>
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
					  	<img class='images'
             				src="<?php
									 echo Url::base()."/images/user-iconnew.png" ;
							
								?>"
             width="100" height="100"> </img>
					  	<?php 
					  	
					  }
             }             	?>
                            <p>
                                <?php echo Yii::$app->user->identity->username;?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                       
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn  btn-default">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
<style>
.images{
    width: 25px;
    height: 25px;
    border-radius: 50%;
    margin-right: 10px;
    margin-top: -2px;
}

</style>