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
use app\modules\patients\models\DoctorNghPatient;
use app\modules\doctors\models\Doctors;

use app\modules\nursinghomes\models\Nursinghomes;

$this->title = $patmodel->firstName;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$reqmodel = DoctorNghPatient::find()->where(['patientHistoryId' => $infoid])->one();

$docid = '';
if(!empty($reqmodel)){
$docid = $reqmodel->doctorId;
$docnmodel = Doctors::find()->where(['userId' => $reqmodel->doctorId])->one();
}
else{
	$reqmodel = new DoctorNghPatient();
}

?>
<div class="doctors-view">
<div class="box box-primary">
<div class="box-body">
<div class="container" id="print">
<style>
th {
	display: none;
}
h3 {
	margin-top:0px;
	padding-left: 208px;
}
.right-second1 {
    font-size: 15px;
     width: 0%; 
    color: #676b6d;
    margin: 10px;
    float: left;
  /*  word-wrap: break-word;*/
</style>

    <div class="row">      
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px; padding-left: 0px;">			   
	<div class="panel panel-info">		
	<div class="panel-body">		   
    <div class="row">
   
    
	<h3><?php 
	 $model1 = Nursinghomes::find()->select('nursingHomeName')->where(['nuserId' =>Yii::$app->user->identity->id])->one();
	 //print_r(Yii::$app->user->identity->id);exit;
	 if($model1->nursingHomeName != ''){
									
							    echo 	$model1->nursingHomeName;
								}else{
									echo 'Not Mentioned';
								}?></h3>
	
	<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
	<div class="doctor-box">
   
						    <?php 
						    $cdate = $model->createdDate;
						    $yrdata= strtotime($cdate);
						    $yeardata= date('d-M-Y', $yrdata);?>
						    <div><h6 style="margin-left: 350px;">Date: <?php echo $yeardata ?></h6></div>
						
					<div class="col-md-8">	
						<div class="box4" style="float: left; color:#389">
						<div class="right" style=" width: 40%">Patient Name</div>								
						<div class="right-content" style="  width: 0% ">:</div>
						<div class="right-second1"><?= $patmodel->firstName; ?>&nbsp;<?= $patmodel->lastName; ?></div>
						
						
						
						
						</div>				
				  </div>
					    
				   <div class="col-md-3" style="float: left;">
								<?php if($patmodel->patientImage != ''){?>
					<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$patmodel->patientImage;?>
					<?php  } ?>
					<?= DetailView::widget([
							'model' => $patmodel,
							'attributes' => [
									[
											'attribute'=>'patientImage',
											'format' => 'html',
											'value'=>Html::img($patmodel->patientImage ? $imgeurl : 'images/user-iconnew.png',['width' => '100px','height' => '100px']),],],]) ?>
					
					</div>	
					 </div> <!---doctor-box closed-->
                     </div>	<!---main-wrap closed-->
					
					
					
                    
                    <div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
                    <div class="doctor-box">
                    <div class="right">Mobile</div>								
					<div class="right-content">:</div>
					<div class="right-second">
					<?php if(!empty($patmodel->mobile)){echo $patmodel->mobile;}else{echo 'Not Mentioned';}?></div>
                    </div> 
                    </div>
						
						
						
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
						<div class="doctor-box">
						
						<div class="right" >Unique ID</div>								
						<div class="right-content">:</div>
						<div class="right-second"><?= $patmodel->patientUniqueId; ?></div>
						
								<div class="right">Gender</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $patmodel->gender; ?></div>
								
								<div class="right">Age</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?=  $patmodel->age ?> </div>
								
								
								
								<div class="right">Country Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->countryName)){
									echo $patmodel->countryName;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								<div class="right">State Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->stateName)){
									echo $patmodel->stateName;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">City Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($patmodel->city)){
									echo $patmodel->city;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								
								
								<div class="right">District</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->district)){
									echo $patmodel->district;;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								
								<div class="right">Mandal</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->mandal)){
									echo $patmodel->mandal;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Village</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($patmodel->village)){
									echo $patmodel->village;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Pin Code</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								 
									<?php if(!empty($patmodel->pinCode)){
									echo $patmodel->pinCode;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								<div class="right">Height</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->height)){
									echo $model->height;;
								}else{
									echo 'Not Mentioned';
								}?></div>

								
								<div class="right">Weight</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($model->weight)){
									echo $model->weight;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Respiration Rate</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->respirationRate)){
									echo $model->respirationRate;;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								<div class="right">BP Left Arm</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->BPLeftArm; ?></div>
								
								<div class="right">BP Right Arm</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->BPRightArm; ?></div>
													        
							    <div class="right">Pulse Rate</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($model->pulseRate)){
									echo $model->pulseRate;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Temparature</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->temparatureType)){
									echo $model->temparatureType;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Diseases</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->diseases)){
									echo $model->diseases;;
								}else{
									echo 'Not Mentioned';
								}?></div>
													        
								<div class="right">Allergic Medicine</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($model->allergicMedicine)){
									echo $model->allergicMedicine;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Patient Compliant</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($model->patientCompliant)){
									echo $model->patientCompliant;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
                            </div> <!---doctor-box closed-->
						    </div>	<!---main-wrap closed-->
								
								 <?php if($reqmodel->treatment == ''){
	                                  $DocrequUrl = Yii::$app->urlManager->createAbsoluteUrl ( [ 
		                              'patients/patients/request-doctor' ,'phsId' => $model->patientInfoId ] );?>
                            <a href="<?php echo $DocrequUrl;?>" class="btn btn-info" role="button" style="margin-left:20px">Request To Doctor</a>
								 
								<?php }else{
									   $udate = $reqmodel->updatedDate;
						    $uydata= strtotime($udate);
						    $uuudata= date('d-M-Y', $uydata);?>
						    
						
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
						<div class="doctor-box">
						 <div><h6 style="margin-left: 384px;">Date: <?php echo $uuudata ?></h6></div>
								<div class="right">Prescription</div>								
								<div class="right-content">:</div>
								<div class="right-second"> <?php 
								
								if($reqmodel->treatment !='')
								{
									echo $reqmodel->treatment;
								}
								else {
									echo 'Not Mentioned';
								}
								 ?> </div>
								
								<div class="right">Doctor Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php   if($docnmodel->name != '')
								{
									echo $docnmodel->name ;
								}else {
									echo 'Not Mentioned';
								}
								?> </div>
						   </div>
					   </div>	  
					  
								<?php 	
								}
								?>									 							
							 							
												
					</div><!---row closed-->						
				</div><!---panel-body closed-->		
			</div><!---panel-info closed-->	
		</div><!---toppad-->
	</div><!--row closed-->
	
	                           
</div>
<button class="btn btn-primary" onclick="printContent('print')" style="    margin-left: 480px; margin-top: 7px;">Print</button>
</div>
</div>


