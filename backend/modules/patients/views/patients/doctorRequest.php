<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-form">

<div class="box box-primary">
<div class="box-body"> 


   
    <?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
    
    <div class="form-group col-lg-6 col-sm-12">
   
    <?= $form->field($model, 'doctor')->dropDownList($avialableDoctors,['prompt'=>'Select Available Doctors']);?>
	</div>
	
	
	<div class="form-group col-lg-6 col-sm-12 " >
	<?= $form->field($model, 'phsId')->hiddenInput()->label(false) ?>
        <?= Html::submitButton('Request', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>


<div class="row">      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px; padding-left: 0px;">			   
			<div class="panel panel-info">		
					
					
				<div class="panel-body">		   
					<!--form section start -->
	
					<div class="row">
					   <h3>Patient Information</h3>
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">
							<div class="right">Patient Image</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?php if($mpatientModel->patientImage != ''){?>
					<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$mpatientModel->patientImage;?>
					<?php  } ?>
					<?= DetailView::widget([
							'model' => $mpatientModel,
							'attributes' => [
									[
											'attribute'=>'patientImage',
											'format' => 'html',
											'value'=>Html::img($mpatientModel->patientImage ? $imgeurl : 'images/user-iconnew.png',['width' => '200px','height' => '150px']),
        		],
        ],
    ]) ?></div>
							<div class="right">Patient Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $mpatientModel->firstName; ?>&nbsp;<?= $mpatientModel->lastName; ?></div>
								
								<div class="right">PatientUnique ID</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $mpatientModel->patientUniqueId; ?></div>
													        
								<div class="right">Gender</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $mpatientModel->gender; ?></div>
								
								<div class="right">Age</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?=  $mpatientModel->age ?> </div>
								
								
								
								<div class="right">Country Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($mpatientModel->countryName)){
									echo $mpatientModel->countryName;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								
								<div class="right">State Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($mpatientModel->stateName)){
									echo $mpatientModel->stateName;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">City Name</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($mpatientModel->city)){
									echo $mpatientModel->city;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								
								
								<div class="right">District</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($mpatientModel->district)){
									echo $mpatientModel->district;;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								
								<div class="right">Mandal</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($mpatientModel->mandal)){
									echo $mpatientModel->mandal;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Village</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($mpatientModel->village)){
									echo $mpatientModel->village;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Pin Code</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								 
									<?= $mpatientModel->pinCode;?></div>
								<div class="right">Mobile</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								 
									<?= $mpatientModel->mobile;?></div>
						    </div> <!---doctor-box closed-->
						    </div>	<!---main-wrap closed-->
						    <?php 
						    $cdate = $mpatientModel->createdDate;
						    $yrdata= strtotime($cdate);
						    $yeardata= date('d-M-Y', $yrdata);
						    
						    ?>
						    
						    		 <h3>Previous Information on <?php echo $yeardata ?></h3>
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">
									
									
								
								
								<div class="right">Height</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($mpatientInformationModel->height)){
									echo $mpatientInformationModel->height;;
								}else{
									echo 'Not Mentioned';
								}?></div>

								
								<div class="right">Weight</div>								
								<div class="right-content">:</div>
								<div class="right-second">
									<?php if(!empty($mpatientInformationModel->weight)){
									echo $mpatientInformationModel->weight;;
								}else{
									echo 'Not Mentioned';
								}?></div>
								
								<div class="right">Respiration Rate</div>								
								<div class="right-content">:</div>
								<div class="right-second">
								<?php if(!empty($mpatientInformationModel->respirationRate)){
									echo $mpatientInformationModel->respirationRate;;
								}else{
									echo 'Not Mentioned';
								}?> </div>
								<div class="right">BP LeftArm</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $mpatientInformationModel->BPLeftArm; ?></div>
								
								<div class="right">BP RightArm</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $mpatientInformationModel->BPRightArm; ?></div>
													        
								<div class="right">Pulse Rate</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $mpatientInformationModel->pulseRate; ?></div>
								
								<div class="right">Temparature</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?=  $mpatientInformationModel->temparatureType; ?> </div>
								
								<div class="right">Diseases</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $mpatientInformationModel->diseases; ?></div>
													        
								<div class="right">AllergicMedicine</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $mpatientInformationModel->allergicMedicine; ?></div>
								
								<div class="right">PatientCompliant</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?=  $mpatientInformationModel->patientCompliant; ?> </div>
								
								
								
																 							
							  </div> <!---doctor-box closed-->
						    </div>	<!---main-wrap closed-->							
												
					</div><!---row closed-->						
				</div><!---panel-body closed-->		
			</div><!---panel-info closed-->	
		</div><!---toppad-->
	</div><!--row closed-->	
	
	
	
</div>
<style>
.help-block {
    height: 5px;
}
.select2-search__field {
	display: none;
}
</style>