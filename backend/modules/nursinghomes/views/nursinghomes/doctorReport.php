<?php


use app\modules\patients\models\Patients;
use app\modules\doctors\models\Doctors;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consultant Report';
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
	<th>Patient  Name</th>
	<th>Doctor Name</th>
	<th>Prescription Date</th>
	</tr>
	<?php 
	for($m=0,$n=0;$m<count($patary),$n<count($cdate);$m++,$n++)
	{
		$sno=$m+1;
	?>
	<tr>
	<td><?php echo $sno;?></td>
	<td><?php echo $patary[$m];?></td>
	<td><?php echo $docary[$m];?></td>
	<td><?php  echo $cdate[$n];?></td>
	
<?php 			
	}	
	?>
	
</tr>
</table>
</div>
</div>
</div>

