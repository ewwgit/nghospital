<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\web\View;

$this->title = 'Patients History';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
<?php 
$historyform = '<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Height:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'height')->textInput(['maxlength' => true])->label(false).'</div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Weight:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'weight')->textInput(['maxlength' => true])->label(false).'</div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Resp Rate:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'respirationRate')->textInput(['maxlength' => true])->label(false).'</div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Pulse Rate:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'BPLeftArm')->textInput(['maxlength' => true])->label(false).'</div>
</div>    
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">BpLeft Arm:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'BPRightArm')->textInput(['maxlength' => true])->label(false).'</div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">BPRight Arm:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'pulseRate')->textInput(['maxlength' => true])->label(false).'</div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Temp Type:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'temparatureType')->textInput(['maxlength' => true])->label(false).'</div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Diseases:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'diseases')->textInput(['maxlength' => true])->label(false).'</div>
</div> 
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">AllergicMedicine:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'allergicMedicine')->textInput(['maxlength' => true])->label(false).'</div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
	<div class="col-lg-4 col-sm-12">Compliant:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'patientCompliant')->textarea(['rows' => 6])->label(false).'</div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Document:</div> <div class="col-lg-8 col-sm-12">'.$form->field($model, 'documentUrl[]')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => ['previewFileType' => 'any']
])->label(false).'</div>
</div>
</div>
			
			<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12"></div> <div class="col-lg-8 col-sm-12"> </div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12"></div> <div class="col-lg-8 col-sm-12"></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12"></div> <div class="col-lg-8 col-sm-12">'.Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']).'</div>
</div>
</div>';
?>
<?php 

$items = [
		[
				'label'=>'<i class="fa fa-map-marker"></i> Information',
				'content'=>$historyform,
				'active'=>true,
		],
		[
				'label'=>'<i class="fa fa-history"></i> Previous Records',
				'content'=>'Previous Records',
		],
		[
				'label'=>'<i class="fa fa-paperclip"></i> Documents',
				'content'=>'Documents',
		],
		[
				'label'=>'<i class="fa fa-sticky-note-o"></i> Clinical Notes',
				'content'=>'Clinical Notes',
		],
		
		
];
?>
<div><input type="text" placeholder="Patient Unique Number" value="<?= $model->patientUniqueId;?>" id="uniqunum" /> <input type="button" value="Search" id="searchpatient"></div>
<div class="box box-primary">
<div class="box-body">

<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">First Name:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'firstName')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Last Name:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'lastName')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Gender:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => 'Select Gender'])->label(false); ?></div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Age:</div> <div class="col-lg-8 col-sm-12"> <?= $form->field($model, 'age')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Date of Birth:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'dateOfBirth')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Date Of Birth ...' ],'pluginOptions' => [ 'autoclose' => true , 'format' => 'dd-M-yyyy'] ] )->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Country:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries'])->label(false);;?></div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">State:</div> <div class="col-lg-8 col-sm-12">
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
    <div class="col-lg-4 col-sm-12">District:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'district')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">City:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'city')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Mandal:</div> <div class="col-lg-8 col-sm-12"> <?= $form->field($model, 'mandal')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Village:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'village')->textInput(['maxlength' => true])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Pin Code:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'pinCode')->textInput(['maxlength' => 8])->label(false); ?></div>
</div>
</div>
<div class="row">
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Mobile:</div> <div class="col-lg-8 col-sm-12"><?= $form->field($model, 'mobile')->textInput(['maxlength' => 10])->label(false); ?></div>
</div>
<div class="form-group col-lg-4 col-sm-12">
    <div class="col-lg-4 col-sm-12">Image:</div> <div class="col-lg-8 col-sm-12"><?=$form->field ( $model, 'patientImage' )->widget ( FileInput::classname (),
   		[ 'options' => [ 'accept' => 'image/*' ],'pluginOptions' =>[[ 'browseLabel' => 'Patient Image', 'allowedFileExtensions'=>['jpg','png','jpeg'] ]] ] )->label(false);?></div>
</div>
  <?php if($model->patientimageupdate != ''){?>
<div class="form-group col-lg-4 col-sm-12">
  

    <img class='image' 
							src="<?php
							if($model->patientimageupdate)
							{
								
								echo isset( $model->patientimageupdate)? Url::base().'/'.$model->patientimageupdate : '' ;
							
							}else {
									 echo Url::base()."/images/user-iconnew.png" ;
								      }
								?>"
							width="100" height="100"> </img> 

</div>
<?php } ?>

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
	   month[0] = "Jan";
	   month[1] = "Feb";
	   month[2] = "Mar";
	   month[3] = "Apr";
	   month[4] = "May";
	   month[5] = "Jun";
	   month[6] = "Jul";
	   month[7] = "Aug";
	   month[8] = "Sep";
	   month[9] = "Oct";
	   month[10] = "Nov";
	   month[11] = "Dec";
	   var finalmonth = month[currentMonth];
	   var finaldate = pad(currentDay, 2); 
	   $('#patients-dateofbirth').val(finaldate+'-'+finalmonth+'-'+birthyear);
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
	   $('#patients-age').val(age);
	   //console.log(age);
   });
   
	
});
</script>