<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\DetailView;
use yii\web\View;
use app\modules\patients\models\DoctorNghPatient;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Patient Request Details';
$this->params ['breadcrumbs'] [] = [
		'label' => 'Patient Requests',
		'url' => [
				'/doctors/doctors/patient-requests'
		]
];
$this->params ['breadcrumbs'] [] = $this->title;
$tremodel = DoctorNghPatient::find()->where(['patientHistoryId' => $mpatientInformationModel->patientInfoId])->one();
//print_r($tremodel->patientRequestStatus);exit();
?>

<div class="doctors-form">

	<div class="box box-primary">
		<div class="box-body"> 
		<?php if($tremodel->patientRequestStatus != 'COMPLETED')
		{
			
		?>

    <?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
    
    <div class="form-group col-lg-6">
   	<div><h4>Prescription</h4></div>
    <?= $form->field($model, 'treatment')->textarea(['rows' => 4])->label(false);?>
	</div>

	<div class="form-group col-lg-6 col-sm-12 ">
	<?= $form->field($model, 'phsId')->hiddenInput()->label(false)?>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary'])?>
    </div>
    <?php ActiveForm::end(); ?>
   <?php }
   else {
   	?>
   	 <?php 
						    $cdate = $tremodel->updatedDate;
						    $yrdata= strtotime($cdate);
						    $yeardata= date('d-M-Y', $yrdata);
						    
						    ?>
   
						<div class="form-group col-md-6 col-sm-12 col-xs-6" style="border: 1px solid #bce8f1; border-radius:5px; color:#369">
							<div class="right">Prescription</div>
							<div class="right-content">:</div>
							<div class="right-second docname"><?php echo  $tremodel->treatment ?></div>
							
							<div class="right">Date</div>
							<div class="right-content">:</div>
							<div class="right-second docname"><?php echo $yeardata;  ?></div>
							 <div class="right">Request Type</div>
							<div class="right-content">:</div>
							<div class="right-second docname"><?php echo $tremodel->RequestType;  ?></div>

							
							

						</div>
						<!---main-wrap closed-->
					
					
		<?php 
        }
		?>
    
    
    
    <div class="form-group col-lg-12 col-sm-12">
				<div id="content_1"	class="inv docinfomaincls">
					<div class="row">
						<div class="form-group col-md-6 col-sm-12 col-xs-6 " style="border: 1px solid #bce8f1; border-radius:5px;">
							<div class="right">Name</div>
							<div class="right-content">:</div>
							<div class="right-second docname"></div>

							<div class="right">Qualification</div>
							<div class="right-content">:</div>
							<div class="right-second docquali"></div>

							<div class="right">Specialities</div>
							<div class="right-content">:</div>
							<div class="right-second docspec"></div>
							

						</div>
						<!---main-wrap closed-->
					</div>
				</div>

				<div class="row">
					<div
						class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad"
						style="margin-left: 0px; padding-left: 0px;">
						<div class="panel panel-info">

							<div class="panel-body">
								<!--form section start -->

								<div class="row">
									<h3>Patient Information</h3>
									<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
										<div class="doctor-box">
											<div class="right">Patient Image</div>
											<div class="right-content">:</div>
											<div class="right-second">
											<?php if($mpatientModel->patientImage != ''){?>
					<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$mpatientModel->patientImage;?>
					<?php  } ?>
					<?= DetailView::widget([
							'model' => $mpatientModel,
							'attributes' => [
									[
											'attribute'=>'',
											'format' => 'html',
											'value'=>Html::img($mpatientModel->patientImage ? $imgeurl : 'images/user-iconnew.png',['width' => '150px','height' => '150px']),
        		],
        ],
    ]) ?>
											
											
											</div>
											<div class="right">Patient Name</div>
											<div class="right-content">:</div>
											<div class="right-second"><?= $mpatientModel->firstName; ?>&nbsp;<?= $mpatientModel->lastName; ?></div>

											<div class="right">Patient Unique ID</div>
											<div class="right-content">:</div>
											<div class="right-second"><?= $mpatientModel->patientUniqueId; ?></div>

											<div class="right">Gender</div>
											<div class="right-content">:</div>
											<div class="right-second"><?= $mpatientModel->gender; ?></div>

											<div class="right">Age</div>
											<div class="right-content">:</div>
											<div class="right-second"><?=  $mpatientModel->age ?> </div>

											<div class="right">Country</div>
											<div class="right-content">:</div>
											<div class="right-second">
								<?php if (! empty ( $mpatientModel->countryName )) {
									echo $mpatientModel->countryName;
									;
								} else {
									echo 'Not Mentioned';
								}
								?></div>
											<div class="right">State</div>
											<div class="right-content">:</div>
											<div class="right-second">
								<?php if (! empty ( $mpatientModel->stateName )) {
									echo $mpatientModel->stateName;
									;
								} else {
									echo 'Not Mentioned';
								}
								?></div>

											<div class="right">City</div>
											<div class="right-content">:</div>
											<div class="right-second">
									<?php
									
if (! empty ( $mpatientModel->city )) {
										echo $mpatientModel->city;
										;
									} else {
										echo 'Not Mentioned';
									}
									?></div>
											<div class="right">District</div>
											<div class="right-content">:</div>
											<div class="right-second">
								<?php
								
if (! empty ( $mpatientModel->district )) {
									echo $mpatientModel->district;
									;
								} else {
									echo 'Not Mentioned';
								}
								?> </div>

											<div class="right">Mandal</div>
											<div class="right-content">:</div>
											<div class="right-second">
								<?php
								
if (! empty ( $mpatientModel->mandal )) {
									echo $mpatientModel->mandal;
									;
								} else {
									echo 'Not Mentioned';
								}
								?></div>

											<div class="right">Village</div>
											<div class="right-content">:</div>
											<div class="right-second">
								<?php
								
if (! empty ( $mpatientModel->village )) {
									echo $mpatientModel->village;
									;
								} else {
									echo 'Not Mentioned';
								}
								?></div>

											<div class="right">Pin Code</div>
											<div class="right-content">:</div>
											<div class="right-second">
								 
									<?php if(!empty($mpatientModel->pinCode)){
									echo $mpatientModel->pinCode;
								     }else{
									echo 'Not Mentioned';
								     }?></div>
											<div class="right">Mobile Number</div>
											<div class="right-content">:</div>
											<div class="right-second">
							
									<?php if(!empty($mpatientModel->mobile)){
									echo $mpatientModel->mobile;
								}else{
									echo 'Not Mentioned';
								}?></div>
								<div class="right">Aadhar Number</div>
											<div class="right-content">:</div>
											<div class="right-second">
							
									<?php if(!empty($mpatientModel->aadhar_number)){
									echo $mpatientModel->aadhar_number;
								}else{
									echo 'Not Mentioned';
								}?></div>
										</div>
										<!---doctor-box closed-->
									</div>
									<!---main-wrap closed-->
						    <?php
										$cdate = $mpatientModel->createdDate;
										$yrdata = strtotime ( $cdate );
										$yeardata = date ( 'd-M-Y', $yrdata );
										
										?>
						    
						    		 <h3>Previous Information on <?php echo $yeardata ?></h3>
									<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
										<div class="doctor-box">

											<div class="right">Height</div>
											<div class="right-content">:</div>
											<div class="right-second">
								<?php
								
if (! empty ( $mpatientInformationModel->height )) {
									echo $mpatientInformationModel->height;
									;
								} else {
									echo 'Not Mentioned';
								}
								?></div>
											<div class="right">Weight</div>
											<div class="right-content">:</div>
											<div class="right-second">
									<?php
									
if (! empty ( $mpatientInformationModel->weight )) {
										echo $mpatientInformationModel->weight;
										;
									} else {
										echo 'Not Mentioned';
									}
									?></div>

											<div class="right">Respiration Rate</div>
											<div class="right-content">:</div>
											<div class="right-second">
								<?php
								
if (! empty ( $mpatientInformationModel->respirationRate )) {
									echo $mpatientInformationModel->respirationRate;
									;
								} else {
									echo 'Not Mentioned';
								}
								?> </div>
											<div class="right">BP</div>
											<div class="right-content">:</div>
											<div class="right-second"><?= $mpatientInformationModel->BPLeftArm; ?></div>

										

											<div class="right">Pulse Rate</div>
											<div class="right-content">:</div>
											<div class="right-second"><?php if (! empty ( $mpatientInformationModel->pulseRate )) {
									        echo $mpatientInformationModel->pulseRate;;
								            } else {
									           echo 'Not Mentioned';
								                     } ?></div>

											<div class="right">Temperature</div>
											<div class="right-content">:</div>
											<div class="right-second">
											<?php if (! empty ( $mpatientInformationModel->temparatureType )) {
									        echo $mpatientInformationModel->temparatureType;;
								            } else {
									           echo 'Not Mentioned';
								                     } ?> </div>

											<div class="right">Diagnosis</div>
											<div class="right-content">:</div>
											<div class="right-second">
											<?php if (! empty ( $mpatientInformationModel->diseases )) {
									        echo $mpatientInformationModel->diseases;;
								            } else {
									           echo 'Not Mentioned';
								                     } ?></div>

											<div class="right">Allergic Medicine</div>
											<div class="right-content">:</div>
											<div class="right-second">
											<?php if (! empty ( $mpatientInformationModel->allergicMedicine )) {
									        echo $mpatientInformationModel->allergicMedicine;;
								            } else {
									           echo 'Not Mentioned';
								                     } ?></div>

											<div class="right">Patient Compliant</div>
											<div class="right-content">:</div>
											<div class="right-second">
											<?php if (! empty ( $mpatientInformationModel->patientCompliant )) {
									        echo $mpatientInformationModel->patientCompliant;;
								            } else {
									           echo 'Not Mentioned';
								                     } ?> </div>
								            <div class="right">SPO2</div>
											<div class="right-content">:</div>
											<div class="right-second">
											<?php if (! empty ( $mpatientInformationModel->spo2 )) {
									        echo $mpatientInformationModel->spo2;;
								            } else {
									           echo 'Not Mentioned';
								                     } ?> </div>
								                       
										</div>
										
										<!---doctor-box closed-->
									</div>
									<!---main-wrap closed-->
 											
								</div>
								<!---row closed-->
							</div>
							<!---panel-body closed-->
						</div>
						<!---panel-info closed-->
					</div>
					<!---toppad-->
				</div>
				<!--row closed-->

			</div>

		</div>

	</div>
<style>
.help-block {
	height: 5px;
}
.select2-search__field {
	display: none;
}
h3 {
	margin-top: 0px;
	padding-left: 15px;
}
.detail-view td {
	max-width: 150px;
}
</style>

<?php
$doctorInfo = Yii::$app->urlManager->createUrl ( [ 
		'patients/patients/doctor-info' 
] );
$this->registerJs ( "
		$('.docinfomaincls').hide();
		$(document.body).on('change', '#doctornghpatient-doctor' ,function(){
		var docid = $(this).val();
		if(docid != ''){
		$.ajax({
		url: '$doctorInfo',
		type: 'get',
		dataType : 'json',
		data:{docid:docid},
		success : function(data){
		if(jQuery.isEmptyObject(data) == false)
		{
		  $('.docinfomaincls').show();
		  $('.docname').html(data.name);
		$('.docquali').html(data.qualification);
		$('.docspec').html(data.speciality);
		$('.docmob').html(data.mobile);
		}
		else{
		$('.docinfomaincls').hide();
		}
		//console.log(jQuery.isEmptyObject(data));
		
},
});
		}
});

	

		", View::POS_READY, 'storemaps' );
?>