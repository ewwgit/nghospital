<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//**********************//
use common\models\User;
use app\modules\nursinghomes\models\Nursinghomes;
//**********************//

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = $model->nursingId;
$this->title = ' Nursing Homes View';
$this->params['breadcrumbs'][] = ['label' => 'Nursing Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-view">
<div class="container" id="print">
<style>
.doctor-box {
	border: none;
}
th {
	display: none;
}
</style>
    <div class="row">      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px; padding-left: 0px;">			   
			<div class="panel panel-info">	
			
			<div class="col-md-8">	
						<div class="box4" style="float: left;">
						
						<div class="right">Nursing Unique ID</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->nurshingUniqueId; ?></div>
						</div>				
					</div>	
					<div class="col-md-3" style="float: left;">
								
					<?php if($model->nursingImage != ''){?>
					<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->nursingImage;?>
					<?php  } ?>
					<?= DetailView::widget([
							'model' => $model,
							'attributes' => [
									[
											'attribute'=>'nursingImage',
											'format' => 'html',
											'value'=>Html::img($model->nursingImage ? $imgeurl : '/@web/images/user-iconnew.png',['width' => '150px','height' => '150px']),
        		],
        ],
    ]) ?>
					</div>		          
				<div class="panel-body">		   
					<!--form section start -->
	
					<div class="row">
					<?php $usernamedata = User::find()->select(['username','email','status'])->where(['id'=>$model->nuserId])->one();?>
  
      
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">					        
															
								
								<div class="right">Contact Person</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->contactPerson; ?> </div>
								
								<div class="right">User Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $usernamedata['username']; ?></div>
								
								<div class="right">Email</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $usernamedata['email']; ?></div>
								
								<div class="right">Mobile</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->mobile; ?> </div>
								
								<div class="right">Landline</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->landline; ?></div>
								
								<div class="right">Country</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->countryName; ?> </div>
								
								<div class="right">State</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->stateName; ?> </div>
								
								<div class="right">City</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->city; ?></div>
								
								<div class="right">Pin Code</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->pinCode; ?> </div>
								
								<div class="right">Address</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->address; ?></div>
								
								<div class="right">Description</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->description; ?></div>
								<div class="right">Status</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php if($usernamedata['status']==10){echo"Active";}else {echo"In-Active";} ?></div>
								
																 							
							</div><!---doctor-box closed-->							
						</div>	<!---main-wrap closed-->							
					</div><!---row closed-->						
				</div><!---panel-body closed-->		
			</div><!---panel-info closed-->	
		</div><!---toppad-->
	</div><!--row closed-->	
</div>
</div>
<button onclick="printContent('print')">Print</button>
