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
use common\models\User;
$this->title = "Doctors View";
?>

<div class="doctors-view">
<div class="box box-primary">
<div class="box-body">
<div class="container" id="print">
<style>
th {
	display: none;
}
</style>
    <div class="row">      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">			   
			<div class="panel ">		
					<div class="col-md-8">	
						<div class="box4" style="float: left;">
						
						        <div class="right">Doctor Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->name)){echo $doctordata->name;}else{echo 'Not Mentioned';}?></div>
								
						        <div class="right">Unique ID</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $doctordata->doctorUniqueId; ?></div>
						</div>				
					</div>
					
					<div class="col-md-4" style="float: left;">
                    <?php if($doctordata->doctorImage != ''){
					 $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$doctordata->doctorImage;
					  } ?>
					<?= DetailView::widget([
							'model' => $model,
							'attributes' => [
									[
											'attribute'=>'doctorImage',
											'format' => 'html',
											'value'=>Html::img($doctordata->doctorImage ? $imgeurl : 'images/user-iconnew.png',['width' => '150px','height' => '150px']),
        		            ],],]) ?>
					</div>			
          
				<div class="panel-body">		   
					<div class="row">
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">					        
								<div class="right">User Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php $usernamedata = User::find()->select(['username','email','status'])->where(['id'=>$doctordata->userId])->one();
				                      echo $usernamedata['username']; ?>
								</div>
								
								<div class="right">Email</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php echo  $usernamedata['email']; ?> </div>
								
								<div class="right">Qualification</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php if(!empty($docqualiary)){echo implode(" , ",$docqualiary);}else{echo 'Not Mentioned';}?></div>
								
								<div class="right">Specialities</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($docspeciary)){echo implode(" , ",$docspeciary);}else{echo 'Not Mentioned';}?></div>
								
								<div class="right">Country Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->countryName)){echo $doctordata->countryName;}else{echo 'Not Mentioned';}?></div>
								
								
								<div class="right">State Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->stateName)){echo $doctordata->stateName;}else{echo 'Not Mentioned';}?></div>
								
								<div class="right">City Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->city)){echo $doctordata->city;}else{echo 'Not Mentioned';}?></div>
								
								
								
								<div class="right">Present Address</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->address)){echo $doctordata->address;}else{echo 'Not Mentioned';}?> </div>
								
								<div class="right">Permanent Adress</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->permanentAddress)){echo $doctordata->permanentAddress;}else{echo 'Not Mentioned';}?></div>
								
								<div class="right">Pin Code</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->pinCode)){echo $doctordata->pinCode;}else{echo 'Not Mentioned';}?></div>
								
								<div class="right">Mobile</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->doctorMobile)){echo $doctordata->doctorMobile;}else{echo 'Not Mentioned';}?></div>
								
								<div class="right">Summery</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->summery)){echo $doctordata->summery;}else{echo 'Not Mentioned';}?></div>

								
								<div class="right">APMC</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($doctordata->APMC)){echo $doctordata->APMC;}else{echo 'Not Mentioned';}?></div>
								
								<div class="right">TSMC</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($doctordata->TSMC)){echo $doctordata->TSMC;}else{echo 'Not Mentioned';}?> </div>
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
<button class="btn btn-primary" onclick="printContent('print')" style="margin-left: 728px;">Print</button>
</div>
</div>
</div>

