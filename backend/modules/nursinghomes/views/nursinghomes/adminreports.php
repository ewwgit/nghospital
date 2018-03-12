<?php
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\modules\patients\models\DoctorNghPatient;
use app\modules\patients\models\Patients;
use app\modules\Doctors\models\Doctors;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
$this->title = 'Reports';
$this->params['breadcrumbs'][]=$this->title;
?>
<?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>

<div class="doctors-index">
	<div class="box box-primary">
		<div class="box-body">
		
			<div class="row">
				<div class="col-md-2">
				  Type:<?= $form->field($model, 'ntype')->dropDownList(['1'=>'Nursinghomes','2'=>'Doctors'],['prompt'=>'Select Type'])->label(false);?>
   
				</div>
				<div class="col-md-2">
				Name: <?php echo $form->field($model, 'name')->widget(DepDrop::classname(),[
    'pluginOptions'=>[
        'depends'=>['nursinghomes-ntype'],
        'placeholder'=>'Select names',
        'url'=>Url::to(['/nursinghomes/nursinghomes/reportnames'])]])->label(false);?>  
				</div>
				<div class="col-md-3">
				From Date:<?= $form->field($model, 'fromdate')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Date Of Birth ...' ],'pluginOptions' => [ 'autoclose' => true , 'format' => 'yyyy-mm-dd'] ] )->label(false); ?>
				</div>
				<div class="col-md-3">
				To Date:<?= $form->field($model, 'todate')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Date Of Birth ...' ],'pluginOptions' => [ 'autoclose' => true , 'format' => 'yyyy-mm-dd'] ] )->label(false); ?>
				
				</div>
				<div class="col-md-2">
				Consultation Status:<?= $form->field($model, 'requestType')->dropDownList(['Ip Consultation'=>'Ip Consultation','Op Consultation'=>'Op Consultation','Review Consultation'=>'Review Consultation'],['prompt'=>'Select Type'])->label(false);?>	</div>
				</div>
				<div class=" form-group col-md-6" style="paddin-top:10px;">
    				<button type="submit" id='reportsearch' class="btn btn-primary">Search</button> </div>

    <?php ActiveForm::end();
    
    if($model->ntype == 1){
    	//print_r($pname);exit;
    if($pname !=[] && $dname != [] && $count != [])
    {
   ?><table class="table table-striped table-bordered" border=0>
   	<tr >
   		<th style="width:20%;padding-left:15px">S.NO</th>
   		
   		<th >Doctor Name</th>
   		<th >Patient Name</th>
		<th >Count</th>
   	</tr>
   	<tr>
   	<?php
   	$i =0;
   	for($i=0;$i<count($pname);$i++)
   	{
   	?>
   		
   		
   		
   			<td style="width:20%;padding-left:15px"><?php echo $i+1;?></td>
   			<td ><?php echo $dname[$i];?></td>
   			<td ><?php echo $pname[$i];?></td>
   			<td > <?php echo $count[$i];?> </td>
   				</tr>
   			<?php 
   	}
   	
   	?>
   
    </table>
     <?=
    
   
    Html::a( Html::img('images/excel-icon.png',['width' => '100px','height' => '100px']),['/nursinghomes/nursinghomes/excel','type'=>$model->ntype,'name'=>$model->name,'fromdate'=>$model->fromdate,'todate'=>$model->todate,'consultation'=>$model->requestType]) ?>
   
   <?php }
    else {
    	?>
    	<div class="col-md-12 col-lg-12 col-sm-12">
    	<?php echo "Records Not Found";?>
    	</div>
    	<?php 
    }
    }
   else if($model->ntype == 2){
   	if($pname !=[] && $dname != [] && $count != [])
   	{
   	?><table class="table table-striped table-bordered" border=0>
   	   	<tr >
   	   		<th style="width:20%;padding-left:15px">S.NO</th>
   	   		
   	   		<th >Nursinghome Name</th>
   	   		<th >Patient Name</th>
   			<th >Count</th>
   	   	</tr>
   	   	<tr>
   	   	<?php
   	   	$i =0;
   	   	for($i=0;$i<count($pname);$i++)
   	   	{
   	   	?>
   	   		
   	   		
   	   		
   	   			<td style="width:20%;padding-left:15px"><?php echo $i+1;?></td>
   	   			<td ><?php echo $dname[$i];?></td>
   	   			<td ><?php echo $pname[$i];?></td>
   	   			<td > <?php echo $count[$i];?> </td>
   	   				</tr>
   	   			<?php 
   	   	}
   	   	
   	   	?>
   	   
   	    </table>
   	      <?=
    
     Html::a( Html::img('images/excel-icon.png',['width' => '100px','height' => '100px']),['/nursinghomes/nursinghomes/excel','type'=>$model->ntype,'name'=>$model->name,'fromdate'=>$model->fromdate,'todate'=>$model->todate,'consultation'=>$model->requestType]) ?>
  
   	    <?php 
   }
  else {
    	?>
    	<div class="col-md-12 col-lg-12 col-sm-12">
    	<?php echo "Records Not Found";?>
    	</div>
    	<?php 
    }
    }   
   ?>
    
			
		</div>
	</div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">

$(function () {
	$('#reportsearch').click(function(){
	    var type = $('#nursinghomes-ntype').val();
	    var name = $('#nursinghomes-name').val();
	    var fromdate = $('#nursinghomes-fromdate').val();
	    var todate = $('#nursinghomes-todate').val();
	    var consultation = $('#nursinghomes-requesttype').val();
	    if(type != 'Prompt' && name != null && fromdate !='' && todate !='' && consultation != ''){
	    var url = '<?php echo Yii::$app->urlManager->createUrl(['/nursinghomes/nursinghomes/adminreports']);?>';					
		var newurl = url+'&type='+type+'&name='+name+'&fromdate='+fromdate+'&todate='+todate+'&consultation='+consultation;
	    window.location =newurl;
	    }
	});
});

</script>