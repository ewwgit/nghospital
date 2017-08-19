<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\AdminMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-master-form">
	<div class="box box-primary">
		<div class="box-body"> 
   <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);  ?>

  <div class="form-group col-lg-6 col-sm-12">   <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readOnly'=>($model->scenario == 'update')? "readonly" : false]) ?></div>

			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readOnly'=>($model->scenario == 'update')? "readonly" : false]) ?></div>

			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'firstName')->textInput(['maxlength' => 255]) ?></div>

			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'password')->passwordInput() ?></div>



			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'lastName')->textInput(['maxlength' => 255]) ?></div>
			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => 10]) ?></div>

			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'role')->dropDownList($model->roles, ['prompt' => 'Select Role']) ?></div>
	        <div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'idproofs')->textArea([]) ?></div>
            
            <div class="form-group col-lg-6 col-sm-12"> 
   
<?= $form->field($model, 'status')->dropDownList([ '10' => 'Active', '0' => 'In-active', ], ['prompt' => 'Select Status'])?>

</div>

<div class="form-group col-lg-6 col-sm-12">
    
							 <?=$form->field ( $model, 'file' )->widget ( FileInput::classname (),
   		[ 'options' => [ 'accept' => 'image/*' ],'pluginOptions' =>[[ 'browseLabel' => 'Profile Image', 'allowedFileExtensions'=>['jpg','png','jpeg'] ]] ] )?>  
            <?= $form->field($model, 'profileImage')->hiddenInput()->label(false); ?>
            
        
	</div>     
			
			
    <div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'address')->textArea(['rows'=>3,'maxlength' => 255]) ?></div>    
        	

<div class="form-group  col-lg-7  col-sm-12" style="margin-top: 100px;"> 
        <?= Html::submitButton( 'Submit', ['class' =>  'btn btn-primary'])?>
    </div>
			
    

</div>
		</div>
			
		<?php ActiveForm::end(); ?>
	</div>

	<style>
	
.help-block {
    height: 1px;
}

.form-control {
	width: 100%;
}

.input-group {
	width: 100%;
}

.form-group {
	height: 120px;
	margin-bottom: 0;
}

.profileimage {
	margin-left: 382px;
	margin-top: 1px;
}
textarea {
    resize: none;
}
</style>