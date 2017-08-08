<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\DoctorsSpecialities;
use app\modules\doctors\models\Doctors;
use app\modules\specialities\models\Specialities;
use app\modules\doctors\models\DoctorsQualification;
use app\modules\qualifications\models\Qualifications;

?>
	<?php $doctordata = Doctors::find()->select(['name','doctorMobile','doctorImage'])->where(['userId'=>$model->rdoctorId])->one();
	       if($doctordata->doctorImage != ''){
					 $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$doctordata->doctorImage;
					 } 
		  
	    $doctorQulification = DoctorsQualification::find()->select('qualification')->where( ['docId' => $model->rdoctorId])->all();
       	 
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
					
       	//print_r($docqualiary);exit;
					?>
 
<div class="form-group col-lg-3 col-sm-12">
  <div >
  <ul class="list-group">
  <li class="list-group-item">
    						
    <div ><?php echo  Html::img($doctordata->doctorImage ? $imgeurl : 'images/user-iconnew.png',['width' => '200px','height' => '150px']); ?> </div>
  	<div class=" color ">Doctor Name </div>	
  	<div class="col  " >:</div>							
    <div class=" val "><?php echo Doctors::getDoctorname($model->rdoctorId); ?> </div>
  	<div class=" color " >Specialities </div>
  	<div class="col  " >:</div>								
    <div class=" val "><?php echo Specialities::getSpname($model->rspId); ?> </div>
	<div class=" color " >Qualification </div>
	<div class="col  " >:</div>									
    <div ><?php echo  implode(" , ",$docqualiary); ?> </div>
 </li></ul>
</div>
</div>
<style>
.col{
color: #3c8dbc;
margin-left: 79px;
margin-top: -19px;
}
.color{
color: #3c8dbc;
margin-top: 10px;
}
.val{
margin-left: 92px;
margin-top: -18px;

}
</style>



