<?php
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Doctor Report Count';
$this->params['breadcrumbs'][]=$this->title;
?>
<?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>

<div class="doctors-index">
	<div class="box box-primary">
		<div class="box-body">
		
			<div class="row">
				<div class="col-md-4">
				From Date:<?= $form->field($model, 'fromdate')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Date Of Birth ...' ],'pluginOptions' => [ 'autoclose' => true , 'format' => 'yyyy-mm-dd'] ] )->label(false); ?>
				</div>
				<div class="col-md-4">
				To Date:<?= $form->field($model, 'todate')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Date Of Birth ...' ],'pluginOptions' => [ 'autoclose' => true , 'format' => 'yyyy-mm-dd'] ] )->label(false); ?>
				
				</div>
				<div class="col-md-4">
				Status:<?= $form->field($model, 'treatmentstatus')->dropDownList(['prompt'=>'Select Status','PROCESSING'=>'PROCESSING','COMPLETED'=>'COMPLETED'])->label(false);?>	</div>
				</div>
				<div class=" form-group col-md-6" style="paddin-top:10px;">
    				<button type="submit" class="btn btn-primary">Search</button> </div>

    <?php ActiveForm::end();
    
    
   ?>
    <table class="table table-striped table-bordered" border=0>
   	<tr >
   		<th style="width:40%;padding-left:25px">S.NO</th>
   		<th style="width:40%;padding-left:25px" >Doctor Name</th>
		<th style="width:40%;padding-left:25px">Count</th>
   	</tr>
   	<tr>
   	<?php 
   	for($i=0;$i<count($doctorcountary);$i++)
   	{
   		?>
   			<td style="width:40%;padding-left:25px"><?php echo $i+1;?></td>
   			<td style="width:40%;padding-left:25px"><?php echo $dname[$i];?></td>
   			<td style="width:40%;padding-left:25px"><?php echo $count[$i];?></td>
   				</tr>
   			<?php 
   		
   	}
   	?>
   
    </table>
    
			
		</div>
	</div>
</div>