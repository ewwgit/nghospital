<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdminMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-master-form">
	<div class="box box-primary">
		<div class="box-body"> 
   <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);  ?>

  <div class="form-group col-lg-6 col-sm-12">   <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?></div>

			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>

			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?></div>

			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'password')->passwordInput() ?></div>



			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?></div>
			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => 10]) ?></div>

			<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'role')->dropDownList($model->roles) ?></div>

			<div class="form-group col-lg-6 col-sm-12">   <?= $form->field($model, 'file')->fileInput()?>
         <?php if($model->profileImage != ''){?>
         <div class="col-lg-6 col-sm-12 profileimage">
					<img src='../../<?php echo $model->profileImage ; ?>' width="150px"
						height="50px;">
      <?php } ?>
     
</div>
         </div>
         

<div class="form-group col-lg-6 col-sm-12">  <?= $form->field($model, 'address')->textArea([]) ?></div>



				<div class="form-group col-lg-6 col-sm-12"> 
   
<?= $form->field($model, 'status')->dropDownList([ '10' => 'Active', '0' => 'In-active', ], ['prompt' => 'Select Status'])?>

</div>


				<div class="form-group col-lg-6 col-sm-12"> 
        <?= Html::submitButton( 'Submit', ['class' =>  'btn btn-primary'])?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
		</div>
	</div>
	<style>
.form-control {
	width: 100%;
}

.input-group {
	width: 100%;
}

.form-group {
	height: 85px;
	margin-bottom: 0;
}

.profileimage {
	margin-left: 259px;
	margin-top: -75px;
}
</style>