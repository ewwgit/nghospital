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
				  Type:<?= $form->field($model, 'ntype')->dropDownList(['1'=>'Nursinghomes','2'=>'Doctors'],[
    								
    				'prompt'=>'Select Type',
    				'onchange'=>'
             		$.get( "'.Url::toRoute('/nursinghomes/nursinghomes/reportnames').'", { type: $(this).val() } )
                            .done(function( data )
                  			 {
                              $( "#nursinghomes-name" ).html( data );
    							//console.log(data);
                            });
      
    		 '])->label(false);?>
   					<p id="ntype" style="color:red;"></p>
				</div>
				<div class="col-md-2">
				Name: <?php echo $form->field($model, 'name')->dropDownList($nursinghomes,['Select Names'])->label(false);?> 
        <p id="name" style="color:red;"></p> 
				</div>
				<div class="col-md-3">
				From Date:<?= $form->field($model, 'fromdate')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Date Of Birth ...' ],'pluginOptions' => [ 'autoclose' => true , 'format' => 'yyyy-mm-dd'] ] )->label(false); ?>
				<p id="fromdate" style="color:red;"></p>
				</div>
				<div class="col-md-3">
				To Date:<?= $form->field($model, 'todate')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Date Of Birth ...' ],'pluginOptions' => [ 'autoclose' => true , 'format' => 'yyyy-mm-dd'] ] )->label(false); ?>
				<p id="todate" style="color:red;"></p>
				</div>
				<div class="col-md-2">
				Consultation Status:<?= $form->field($model, 'requestType')->dropDownList(['Ip Consultation'=>'Ip Consultation','Op Consultation'=>'Op Consultation','Review Consultation'=>'Review Consultation'],['prompt'=>'Select Type'])->label(false);?>	
				<p id="requestType" style="color:red;"></p></div>
				
				</div>
				
					<div class=" form-group col-md-6" style="paddin-top:10px;">
    				<button type="button" id='reportsearch' class="btn btn-primary">Search</button> </div>

    <?php ActiveForm::end();
    ?>
    <div id='reportstable'>
    <?php 
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
   	?><table class="table table-striped table-bordered"  border=0>
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
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">

$(function () {
	$('#reportsearch').on('click',function(){
		 var type = $('#nursinghomes-ntype').val();		   
		 var name = document.getElementById("nursinghomes-name").value;
		 var fromdate = $('#nursinghomes-fromdate').val();
		 var todate = $('#nursinghomes-todate').val();		    
		 var consultation = $('#nursinghomes-requesttype').val();
		// alert(name);
		 var today = new Date();
		 var dd = today.getDate();
		 var mm = today.getMonth()+1; //January is 0!

		 var yyyy = today.getFullYear();
		 if(dd<10){
		     dd='0'+dd;
		 } 
		 if(mm<10){
		     mm='0'+mm;
		 } 
		 var today = yyyy+'-'+mm+'-'+dd;
		console.log(today);
		if(type == '')
		{
			document.getElementById('ntype').innerHTML="Ntype Cannot Be Blank";			
		}
		else
		{
			document.getElementById("ntype").innerHTML = "";
		}
		if(name == 0)
		{
			document.getElementById('name').innerHTML="Name Cannot Be Blank";			
		}
		else
		{
			document.getElementById("name").innerHTML = "";
		}
		if(fromdate == '')
		{
			document.getElementById('fromdate').innerHTML="From Date Cannot Be Blank";
			
		}
		else if(fromdate > today)
		{
			document.getElementById("fromdate").innerHTML = "From Date must Be current date or less than current date";
		}
		else
		{
			document.getElementById("fromdate").innerHTML = "";
		}
		if(todate == '')
		{
			document.getElementById('todate').innerHTML="To Date Cannot Be Blank";
			
		}
		else if(todate < fromdate)
		{
			document.getElementById('todate').innerHTML="Todate Must Be After From Date";
		}
		else if(todate > today)
		{
			document.getElementById("todate").innerHTML = "to Date must Be current date or greater than current date";
		}
		else
		{
			document.getElementById("todate").innerHTML = "";
		}			
		if(consultation == '')
		{
			document.getElementById('requestType').innerHTML="Request Type Cannot Be Blank";			
		}
		else
		{
			document.getElementById("requestType").innerHTML = "";
		}
		
		 if(type != '' && name !== 0 && consultation != '' && (fromdate <= todate) && (todate >= fromdate) && (fromdate <= today) && (todate <= today)){
			    var url = '<?php echo Yii::$app->urlManager->createUrl(['/nursinghomes/nursinghomes/adminreports']);?>';					
				var newurl = url+'&type='+type+'&name='+name+'&fromdate='+fromdate+'&todate='+todate+'&consultation='+consultation;
			    window.location =newurl;
			    }
		 else
		 {
			 document.getElementById("reportstable").innerHTML = "";
		 }
		
			});
});

</script>