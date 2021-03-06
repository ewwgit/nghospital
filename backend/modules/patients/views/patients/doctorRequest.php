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

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Request Doctor';
$this->params ['breadcrumbs'] [] = [
		'label' => 'Patients',
		'url' => [
				'index'
		]
];
$this->params ['breadcrumbs'] [] = $this->title;
?>

<div class="doctors-form">

	<div class="box box-primary">
		<div class="box-body"> 

    <?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
    <div class="form-group col-lg-3 col-sm-12">
   
    <?= $form->field($model, 'specialities')->dropDownList($sepecialities,['prompt'=>'Select Specialities']);?>
	</div>
    
    <div class="form-group col-lg-3 col-sm-12">
    <?php echo $form->field($model, 'doctor')->widget(DepDrop::classname(),[
                    		'data'=>$avialableDoctors,
    		
    		
    'pluginOptions'=>[
        'depends'=>['doctornghpatient-specialities'],
        'placeholder'=>'Select Available Doctors',
        'url'=>Url::to(['/patients/patients/specialitydoctors'])
    ]
]);
     
 ?>
 
	</div>
	  <div class="form-group col-lg-3 col-sm-12">
   
    <?= $form->field($model, 'RequestType')->dropDownList(['Ip Consultation'=>'Ip Consultation','Op Consultation'=>'Op Consultation','Review Consultation'=>'Review Consultation'],['prompt'=>'Select Type']);?>
	</div>
			<div class="form-group col-lg-3 col-sm-12 ">
	<?= $form->field($model, 'phsId')->hiddenInput()->label(false)?>
        <?= Html::submitButton('Request', ['class' => 'btn btn-primary'])?>
    </div>
    <?php ActiveForm::end(); ?>
    
    <div class="form-group col-lg-12 col-sm-12">
				<div id="content_1"	class="inv docinfomaincls">
					<div class="row">
						<div class="form-group col-md-6 col-sm-12 col-xs-6" style="border: 1px solid #bce8f1; border-radius:5px;">
							<div class="right">Name</div>
							<div class="right-content">:</div>
							<div class="right-second docname"></div>

							<div class="right">Qualifications</div>
							<div class="right-content">:</div>
							<div class="right-second docquali"></div>

							<div class="right">Specialities</div>
							<div class="right-content">:</div>
							<div class="right-second docspec"></div>
							
							
							<div class="right">Summery</div>
							<div class="right-content">:</div>
							<div class="right-second docsummery"></div>
							

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
								<?php
								
if (! empty ( $mpatientModel->countryName )) {
									echo $mpatientModel->countryName;
									;
								} else {
									echo 'Not Mentioned';
								}
								?></div>
											<div class="right">State</div>
											<div class="right-content">:</div>
											<div class="right-second">
								<?php
								
if (! empty ( $mpatientModel->stateName )) {
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
								 
									<?php if(!empty($patmodel->aadhar_number)){
									echo $patmodel->aadhar_number;
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


											<div class="right">Treatment History</div>
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
								                     
											<div class="right">Diagnosis</div>
											<div class="right-content">:</div>
											<div class="right-second">
											<?php if (! empty ( $mpatientInformationModel->diseases )) {
									        echo $mpatientInformationModel->diseases;;
								            } else {
									           echo 'Not Mentioned';
								                     } ?></div>
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
		$('.docsummery').html(data.summery);
		}
		else{
		$('.docinfomaincls').hide();
		}
		//console.log(jQuery.isEmptyObject(data));
		
},
});
		}
		else{
		 $('.docinfomaincls').hide();
		}
});
		
		$(document.body).on('change', '#doctornghpatient-specialities' ,function(){
		$('.docinfomaincls').hide();
		});

	

		", View::POS_READY, 'storemaps' );
?>