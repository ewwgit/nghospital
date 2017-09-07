<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\AdminMaster */
$str = $model->username;
$rest = substr($str, 0, 150);

$this->title = $rest;
//$this->title = $model->username;
//$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-view">
<div class="box box-primary">
<div class="box-body">
 <?php if($model->status == 10){
    $model->status = 'Active';
    }
    else {
    	$model->status = 'In-Active';
    }?>
<div class="container" id="print">
<style>
th {
	display: none;
}
</style>
    <div class="row">      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" > 			   
			<div class="panel ">		
						
          
				<div class="panel-body">		   
					<!--form section start -->
					<div class="right" style="color:#369;">ProFile Image</div>						
					<div class="col-md-3" style="float:left;">					
									       <?php if($model->profileImage != ''){?>
    							<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->profileImage;?>
    							<?php  } ?>
           				   <?= DetailView::widget([
							'model' => $model,
							'attributes' => [
									[
											'attribute'=>'profileImage',
											'format' => 'html',
											'value'=>Html::img($model->profileImage ? $imgeurl : 'images/user-iconnew.png',['width' => '150px','height' => '150px']),
        		      					    ],
                     					  ],
             					    ]) ?> 
             			</div>	
					<div class="row">
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">
															
												        
								<div class="right">User Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->username; ?> </div>
								
								<div class="right">Email</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->email; ?> </div>
								
								<div class="right">Firstname</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->firstName; ?> 
								</div>
								<div class="right">LastName</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->lastName; ?>
								</div>
								<div class="right">PhoneNumber</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->phoneNumber;?>
								</div>
								
								
								<div class="right">Address</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->address;?>
								</div>
								
								<div class="right">Id Proofs</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->idproofs;?>
									</div>
								
								
								
								<div class="right">RoleName</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->role;?>
								</div>
								
								<div class="right">Status</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php  if(!empty($model->status)){
									echo $model->status;;
								}else{
									echo 'Not Mentioned';
								} ?></div>	
								
																 							
							</div><!---doctor-box closed-->							
						</div>	<!---main-wrap closed-->							
					</div><!---row closed-->						
				</div><!---panel-body closed-->		
			</div><!---panel-info closed-->	
		</div><!---toppad-->
	</div><!--row closed-->	
</div>
</div>
</div>
</div>

