<?php


use app\modules\patients\models\DoctorNghPatient;
use app\modules\doctors\models\Doctors;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Previous Records';
$this->params['breadcrumbs'][] = $this->title;
//$sdata = User::find()->select('status')->all();
//$data = $sdata->status;
?>
<div class="doctors-index">
<div class="box box-primary">
<div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  
 <table class="table table-striped table-bordered">
	<tr style="color:#3c8dbc;">
	<th>S.No</th>
	<th>Date</th>
	<th>Doctor Name</th>
	</tr>
	<?php 
	$previousrecordsUrl = Yii::$app->urlManager->createAbsoluteUrl ( [
			'doctors/doctors/patientshistoryview'
	] );
	
	//$doctorname = DoctorNghPatient::find()->select('doctorId')->where(['patientHistoryId' => $model->patientInfoId])->asArray()->one();
	
	//$doctor_name = Doctors::find()->select('name')->where(['userId' => $doctorname])->asArray()->one();
for($m=0; $m<count($model);$m++)
{
	$sno = $m+1;
	
	    $doctorname = DoctorNghPatient::find()->select('doctorId')->where(['patientHistoryId' => $model[$m]['patientInfoId']])->asArray()->one();
		
		$doctor_name = Doctors::find()->select('name')->where(['userId' => $doctorname])->asArray()->one();
		//print_r($doctor_name);
	?>
	<tr>
		<td><?php echo $sno; ?></td>
		
		<td><?php echo '<a href="'.$previousrecordsUrl.'&infoid='.$model[$m]['patientInfoId'].'" target="_blank">'.date("d-M-Y",strtotime($model[$m]['createdDate'])).'</a>'?></td>
		<td><?php if(!empty($doctor_name['name']))
				{
		echo $doctor_name['name'];
					
}
else {
	echo "-";
}?></td>	</tr>
<?php 
	$sno++;
}
?>
	
	
</table>
</div>
</div>
</div>

