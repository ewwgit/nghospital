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
use backend\models\SignupForm;
use app\modules\doctors\models\DoctorsQualification;
use app\modules\qualifications\models\Qualifications;
use app\modules\doctors\models\DoctorsSpecialities;
use app\modules\specialities\models\Specialities;
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
$doctorQulification = DoctorsQualification::find()->select('qualification')->where( ['docId' => $docnmodel->userId])->all();
//print_r($doctorQulification);exit();
$dqary = array();
$docqualiary = array();
if(!empty($doctorQulification))
{
	foreach ($doctorQulification as $dq)
	{
		$dqary[] = $dq->qualification;
	}
}
for($k=0; $k<count($dqary); $k++)
{
	$docquali = Qualifications::find()->select('qualification')->where( ['qlid' => $dqary[$k]])->asArray()->one();
	$docqualiary[] = $docquali['qualification'];
}
$docSpecialities = DoctorsSpecialities::find()->select('rspId')->where( ['rdoctorId' => $docnmodel->userId])->all();
//print_r($docSpecialities);exit();
$dsary = array();
$docspeciary = array();
if(!empty($docSpecialities))
{
	foreach ($docSpecialities as $ds)
	{
		$dsary[] = $ds->rspId;
	}
}
//print_r($dsary);exit();
for($m=0; $m<count($dsary); $m++)
{
	$docspeci = Specialities::find()->select('specialityName')->where( ['spId' => $dsary[$m]])->asArray()->one();
	$docspeciary[] = $docspeci['specialityName'];
}

?>
<div style="background-color:#ffffff !important; margin:10px 0px 0px 10px">
<body style="box-sizing:border-box; font-family: 'Source Sans Pro',sans-serif; margin:0px; padding:0px;background-color:#ffffff !important;">
<div id="print" style="width:60%;  height:auto; overflow:hidden; margin:10px auto; border:1px solid #bce8f1; border-radius:4px; padding:10px; position:relative;">
  <header style="width:100%; float:left; position: relative; border-bottom: 2px solid #5aab4a; padding: 0 10px; box-sizing: border-box;">
    <h1 style="font-family: 'Source Sans Pro',sans-serif; font-size: 38px; color:#ff6600; text-align:center; margin:0px;">CONSULT XP</h1>
    <h3 style="font-family: 'Source Sans Pro',sans-serif; color: #323232; font-size: 18px; text-align:center; margin:0px;">ADDRESS</h3>
    <h2 style="font-family: 'Source Sans Pro',sans-serif; color: #3572af; font-size:22px; padding: 5px 0; text-align:center; margin:0px;">ADVICE FORM</h2>
    <div style="width:100%; float:left; position: relative;">
      <div style="width:50%; float:left; position:relative;">
        <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
          <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">DR NAME <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
          <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php   if($docnmodel->name != '')
														{
															echo $docnmodel->name ;
														}else {
															echo 'Not Mentioned';
														}
													?> </span> </div>
        <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
          <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">SPECIALIZATION <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
          <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($docspeciary)){
									echo implode(" , ",$docspeciary);
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
        <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
          <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">QUALIFICATION <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
          <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($docqualiary)){
									echo implode(" , ",$docqualiary);
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
      </div>
      <?php 
										    $cdate = $model->createdDate;
						   					 $yrdata= strtotime($cdate);
						   					 $yeardata= date('d-M-Y', $yrdata);?>
      <div style="width:50%; float:left; position:relative; margin-top:20px;">
        <h3 style="font-size: 15px; color: #333; float: right; padding:12px 0; text-align: right; margin:0px;">Date: <span><?php echo $yeardata ?></span></h3>
      </div>
    </div>
  </header>
  <aside style="width:100%; float:left; position: relative; border-bottom: 2px solid #5aab4a; padding:10px; padding-bottom:0px; box-sizing: border-box;">
    <div style="width:50%; float:left; position:relative; padding-right:5px; box-sizing:border-box;">
    <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">PATINET UID <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?= $patmodel->patientUniqueId; ?></span> </div>
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">PATIENT NAME <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?= $patmodel->firstName; ?>&nbsp;<?= $patmodel->lastName; ?></span> </div>
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">AGE /SEX <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?=  $patmodel->age ?>/<?= $patmodel->gender; ?></span> </div>
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">COMPLAINTS <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($model->patientCompliant)){
									echo $model->patientCompliant;;
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
     
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">DIAGNOSIS <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($model->diseases)){
									echo $model->diseases;;
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
								   <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">WGT <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($model->weight)){
									echo $model->weight;;
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
    </div>
    
    <div style="width:50%; float:left; position:relative; padding-left:5px; box-sizing:border-box;">
      
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">BP <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?= $model->BPLeftArm; ?></span> </div>
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">TEMP <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($model->temparatureType)){
									echo $model->temparatureType;;
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">SPO<sub>2</sub> <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($model->spo2)){
									echo $model->spo2;;
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">PRATE <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($model->pulseRate)){
									echo $model->pulseRate;;
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
      <div style="width: 100%; float: left; position: relative; padding:0 0 0px 0;">
        <label style="width: 50%; float: left; color: #295a8c; font-size: 14px;">R R <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 50%; float: left;"><?php if(!empty($model->respirationRate)){
									echo $model->respirationRate;;
								}else{
									echo 'Not Mentioned';
								}?></span> </div>
   
    </div>
    <div style="width:100%; float:left; position:relative;">
      <h6 style="color:#3572af; font-weight:600; font-size:14px; text-align:center; margin:0px; padding:10px;">ADVICE</h6>
      <div style="min-height:150px; width:100%; float:left; position:relative; font-size:18px; margin:0 0 10px 0; padding:10px; box-sizing:border-box; border:1px solid #999; border-radius:5px;"> <?php if($reqmodel->treatment){
      	echo 	$reqmodel->treatment;
}
else{
	echo 'Not Mentioned';
}?> </div>
    </div>
  </aside>
  <footer style="width:100%; float:left; position: relative; padding:10px; padding-bottom:0px; box-sizing: border-box;">
    <div style="width: 100%; float: left; position: relative; padding:0px; font-family: 'Source Sans Pro',sans-serif; font-size: 13px; color: #989898; text-align:center;"> NURSING HOME INFORMATION </div>
 	<div style="width: 100%; float: left; position: relative; padding:0px; font-family: 'Source Sans Pro',sans-serif; font-size: 13px; color: #989898; text-align:center;"> <?php 
												 $model1 = Nursinghomes::find()->select('nursingHomeName,address,mobile,nursingImage')->where(['nuserId' =>Yii::$app->user->identity->id])->one();
	 											//print_r(Yii::$app->user->identity->id);exit;
												 if($model1->nursingHomeName != ''){									
							 						  echo 	$model1->nursingHomeName;
													}else{
														echo 'Not Mentioned';
													}?> -  <?php 
								
								if($model1->mobile !='')
								{
									echo $model1->mobile;
								}
								else {
									echo 'Not Mentioned';
								}
								 ?>  </div>
  </footer>
</div>

</body>
</div>
<button class="btn btn-primary" onclick="printContent('print')" style="margin-left: 480px; margin-top: 7px;">Print</button>
