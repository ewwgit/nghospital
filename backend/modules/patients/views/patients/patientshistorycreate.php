<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\web\View;
use app\modules\patients\models\PatientDocuments;
use app\modules\patients\models\DoctorNghPatient;
use app\modules\doctors\models\Doctors;

$this->title = 'Patients History';
$this->params['breadcrumbs'][] = $this->title;
$previousDoc = array();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
<?php 
$historyform = '<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Height:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'height')->textInput(['maxlength' => 8])->label(false).'</div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Weight:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'weight')->textInput(['maxlength' => 6])->label(false).'</div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Resp Rate:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'respirationRate')->textInput(['maxlength' => 3])->label(false).'</div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Pulse Rate:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'pulseRate')->textInput(['maxlength' =>3])->label(false).'</div>
</div>    
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">BP:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'BPLeftArm')->textInput(['maxlength' => 6])->label(false).'</div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Tempe- rature:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'temparatureType')->textInput(['maxlength' => 5])->label(false).'</div>
</div>
</div>
<div class="row">
		
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Compliant:</div> <div class="col-lg-9 col-sm-12">'.
	$form->field($model, 'patientCompliant')->dropDownList(['Fever'=>'Fever','Cough'=>'Cough','Pain abdomen'=>'Pain abdomen','COPD'=>'COPD','Injury'=>'Injury','Burning urination'=>'Burning urination','Chest pain'=>'Chest pain'
			,'Body pains'=>'Body pains','Cold'=>'Cold','Asthma'=>'Asthma','Throat pain'=>'Throat pain','Itching'=>'Itching','Swelling'=>'Swelling','Bleeding'=>'Bleeding','Ulceration'=>'Ulceration','Rash'=>'Rash','Unable to move'=>'Unable to move','
			Shortness of breath'=>'Shortness of breath','Infection over body'=>'Infection over body','Discharge'=>'Discharge','Ear pain'=>'Ear pain','Dis urea'=>'Dis urea','Diarrhea'=>'Diarrhea','Vomiting'=>'Vomiting','Disability'=>'Disability','Constipation'=>'Constipation','Hiccough'=>'Hiccough'
	],['prompt' => 'Complaints'],
											['itemOptions' => ['class' =>'radio-inline']])->label(false).'</div>
</div> 
<div class="form-group col-lg-4 col-sm-12">
			<div class="col-lg-3 col-sm-12">Diagnosis:</div> <div class="col-lg-9 col-sm-12">'.
	$form->field($model, 'diseases')->textInput(['maxlength' => 200])->label(false).'</div>
    </div>
    		 <div class="form-group col-lg-4 col-sm-12">
	<div class="col-lg-3 col-sm-12">SPO2:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'spo2')->textInput(['maxlength' => 100])->label(false).'</div>
</div>

    		
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
<div class="col-lg-3 col-sm-12">Treatment History:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'allergicMedicine')->textarea(['rows'=>4])->label(false).'</div>
					
</div>
   
    <div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Document:</div> <div class="col-lg-9 col-sm-12">'.$form->field($model, 'documentUrl[]')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => ['previewFileType' => 'any']
])->label(false).'</div>
</div>

</div>
			
			<div class="row">
<div class="form-group col-lg-3 col-sm-12">
    <div class="col-lg-3 col-sm-12"></div> <div class="col-lg-9 col-sm-12"> </div>
</div>
<div class="form-group col-lg-3 col-sm-12">
    <div class="col-lg-3 col-sm-12"></div> <div class="col-lg-9 col-sm-12"></div>
</div>
<div class="form-group col-lg-3 col-sm-12">
    <div class="col-lg-3 col-sm-12"></div> <div class="col-lg-9 col-sm-12">'.Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']).'</div>
</div>
</div>';

/* $documents = '<div class="col-lg-7 col-sm-12">
    <div class="col-lg-1 col-sm-12">1.</div> <div class="col-lg-8 col-sm-12"><a href="#">05-07-2017</a></div>
</div>
		<div class="col-lg-7 col-sm-12">
    <div class="col-lg-1 col-sm-12">2.</div> <div class="col-lg-8 col-sm-12"><a href="#">05-07-2017</a></div>
</div>
		<div class="col-lg-7 col-sm-12">
    <div class="col-lg-1 col-sm-12">3.</div> <div class="col-lg-8 col-sm-12"><a href="#">05-07-2017</a></div>
</div>'; */
$previousrecords = '';
$documents = '';
?>
<?php $previousrecordsUrl = Yii::$app->urlManager->createAbsoluteUrl ( [ 
		'patients/patients/patientshistoryview' 
] );

 $DocpreviousrecordsUrl = Yii::$app->urlManager->createAbsoluteUrl ( [ 
		'patients/patients/patientshistorydocview' 
] );?>


<?php if(empty($model->previousRecords))
{
	
	
	$previousrecords .='<div class="col-lg-7 col-sm-12">
    There is no previous records exist.
</div>';
	?>
<!-- <div>There is no previous records exist.</div> -->


<?php }else{
	$pr=1;
	$k=0;
	$s=0;
	$previousrecords .= '<div class="col-lg-7 col-sm-12">
	
 <table class="col-lg-7 col-sm-12 table table-striped table-bordered" border=0>
	<tr>
	<td>S.No</td>
	<td>Date</td>
	<td>Doctor Name</td>
	</tr>';
	
?>


<?php 	
foreach ($model->previousRecords as $previousRecords)
{
	$docInfo = PatientDocuments::find()->where(['patientInfoId'=> $previousRecords->patientInfoId])->all();?>
	
	<?php 	if(!empty($docInfo))
	{
		$previousDoc[$k]['patientInfoId'] = $previousRecords->patientInfoId;
		$previousDoc[$k]['createdDate'] = date("d-M-Y",strtotime($previousRecords->createdDate));
	    $k++;
		
	}
    $doctorname = DoctorNghPatient::find()->select('doctorId')->where(['patientHistoryId' => $previousRecords->patientInfoId])->asArray()->one();

	$doctor_name = Doctors::find()->select('name')->where(['userId' => $doctorname])->asArray()->one();

  $previousrecords .= '

 <tr>
 <td>'.$pr.'</td>
 <td><a href="'.$previousrecordsUrl.'&infoid='.$previousRecords->patientInfoId.'" target="_blank">'.date("d-M-Y",strtotime($previousRecords->createdDate)).'</a></td>
 <td><a href="'.$previousrecordsUrl.'&infoid='.$previousRecords->patientInfoId.'" target="_blank">'.$doctor_name['name'].
    		
	
	'</a></td>
 </tr>
    		';
	?>
	
<?php 
$pr++;
}
$previousrecords .='</table></div>';
}?>

<?php if(empty($previousDoc)){
	$documents .='<div class="col-lg-7 col-sm-12">
    There is no previous documents exist.
</div>';
}else{
	$documents .='<div class="col-lg-7 col-sm-12 ">
		 <table class="col-lg-7 col-sm-12 table table-striped table-bordered" border=0>
	<tr>
	<td>S.No</td>
	<td>Date</td>
	
	</tr>';
for($m=0; $m<count($previousDoc);$m++)
{
	$sno = $m+1;
	$documents .= '
		<tr>
        <td>'.$sno.'.</td> 
		<td class="col-lg-8 col-sm-12"><a href="'.$DocpreviousrecordsUrl.'&infoid='.$previousDoc[$m]['patientInfoId'].'" target="_blank">'
		.$previousDoc[$m]['createdDate'].'</a>
        </td></tr>';
}
$documents .='</table></div>';

}?>

<?php 

$items = [
		[
				'label'=>'<i class="fa fa-map-marker"></i> Information',
				'content'=>$historyform,
				'active'=>true,
		],
		[
				'label'=>'<i class="fa fa-history"></i> Previous Records',
				'content'=>$previousrecords,
		],
		[
				'label'=>'<i class="fa fa-paperclip"></i> Documents',
				'content'=>$documents,
		],
		[
				'label'=>'<i class="fa fa-sticky-note-o"></i> Clinical Notes',
				'content'=>'There is no records ',
		],
		
		
];
?>
<div style="margin-bottom: 5px;"><input style="height: 30px; padding-top: 0px;" type="text" placeholder="Patient Unique Number" value="<?= $model->patientUniqueId;?>" id="uniqunum" /> <input class="btn btn-primary" type="button" value="Search" id="searchpatient" style="height: 30px; padding-top: 4px;"></div>
<div class="box box-primary">
<div class="box-body">

<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">First Name:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'firstName')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Last Name:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'lastName')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Gender:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => 'Select Gender'])->label(false); ?></div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Age:</div> <div class="col-lg-9 col-sm-12"> <?= $form->field($model, 'age')->textInput(['maxlength' => 3])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Date of Birth:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'dateOfBirth')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Date Of Birth ...' ],'pluginOptions' => [ 'autoclose' => true , 'format' => 'yyyy-mm-dd'] ] )->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Country:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries','disabled' => true])->label(false);;?></div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">State:</div> <div class="col-lg-9 col-sm-12">
    <?php echo $form->field($model, 'state')->widget(DepDrop::classname(),[
                    		'data'=>$model->statesData,
    		
    		
    'pluginOptions'=>[
        'depends'=>['patients-country'],
        'placeholder'=>'Select States',
        'url'=>Url::to(['/patients/patients/states'])
    ]
])->label(false);
     
 ?>
  </div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">District:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'district')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">City:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'city')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Mandal:</div> <div class="col-lg-9 col-sm-12"> <?= $form->field($model, 'mandal')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Village:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'village')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Pin Code:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'pinCode')->textInput(['maxlength' => 8])->label(false); ?></div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Mobile:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'mobile')->textInput(['maxlength' => 10])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Aadhar Number:</div> <div class="col-lg-9 col-sm-12"><?= $form->field($model, 'aadhar_number')->textInput(['minlength'=>12,'maxlength' => 12])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-3 col-sm-12">Image:</div> <div class="col-lg-9 col-sm-12"><?=$form->field ( $model, 'patientImage' )->widget ( FileInput::classname (),
   		[ 'options' => [ 'accept' => 'image/*' ],'pluginOptions' =>[[ 'browseLabel' => 'Patient Image', 'allowedFileExtensions'=>['jpg','png','jpeg'] ]] ] )->label(false);?></div>
</div>
<div class="pad">
  <?php if($model->patientimageupdate != ''){?>
  

    <img class='image' 
							src="<?php
							if($model->patientimageupdate)
							{
								
								echo isset( $model->patientimageupdate)? Url::base().'/'.$model->patientimageupdate : '' ;
							
							}else {
									 echo Url::base()."/images/user-iconnew.png" ;
								      }
								?>"
							width="100" height="100" style="float:right;"> </img> 


<?php } ?>
</div>
</div>
<div class="form-group col-lg-12 col-sm-12" style="border-bottom: 1px solid #ccc;">
<?php 
// Ajax Tabs Above
echo TabsX::widget([
		'items'=>$items,
		'position'=>TabsX::POS_ABOVE,
		'encodeLabels'=>false
]);
?>
</div>


</div>
</div>
<?php ActiveForm::end(); ?>
<?php $searchUrl = Yii::$app->urlManager->createAbsoluteUrl ( [ 
		'patients/patients/patientshistorycreate' 
] );?>
<script>
$( document ).ready(function() {
   $('#searchpatient').on('click',function(){
	   var uniqnum = $('#uniqunum').val();
	   window.location.replace('<?php echo $searchUrl;?>&id='+uniqnum);
	   });

   $('#patients-age').on('change',function(){
	   var d = new Date();
	   var currentYear = d.getFullYear();
	   var currentMonth = d.getMonth();
	   var currentDay = d.getDate();
	   var agenew = $(this).val();
	   var birthyear = currentYear-agenew;
	   var month = new Array();
	   month[0] = "1";
	   month[1] = "2";
	   month[2] = "3";
	   month[3] = "4";
	   month[4] = "5";
	   month[5] = "6";
	   month[6] = "7";
	   month[7] = "8";
	   month[8] = "9";
	   month[9] = "10";
	   month[10] = "11";
	   month[11] = "12";
	   var finalmonth = month[currentMonth];
	   var finaldate = pad(currentDay, 2); 
	   $('#patients-dateofbirth').val(birthyear+'-'+finalmonth+'-'+finaldate);
	   //console.log(birthyear)
	   });

   function pad (str, max) {
	   str = str.toString();
	   return str.length < max ? pad("0" + str, max) : str;
	 }

   $('#patients-dateofbirth').on('change',function(){
	   var curdob = $(this).val();
	   dob = new Date(curdob);
	   var today = new Date();
	   var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
	   if(curdob == '')
	   {
		   $('#patients-age').val('');
	   }
	   else{
		   if(age < 1)
		   {
	          $('#patients-age').val(0);
		   }
		   else{
			   $('#patients-age').val(age);  
		   }
	   }
	   //console.log(age);
   });
   
	
});
</script>
<style>
.help-block {
    height: 10px;
    margin-bottom: 15px;
    margin-top: 0px;
}
.form-group {
	margin-bottom: 0px;
	margin-top: 0px;
}
.krajee-default.file-preview-frame .file-thumbnail-footer {
	height: 60px;
}
.krajee-default .file-actions {
	margin-top: 0px;
	}
.krajee-default.file-preview-frame {
	margin: -2px;
	}
.file-preview {
	padding: 0px 5px 5px;
	}
.close {
	font-size: 20px;
}
td {
line-height: 1.8;
}
textarea {
    resize: none;
}
.pad{
padding:0px 32px 0px 0px;
}
</style>