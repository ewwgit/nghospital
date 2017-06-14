<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-form">

   
    <?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'confirmpassword')->passwordInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'qualification')->textInput(['maxlength' => true]) ?>
	</div>
	 <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries']);?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
     <?php echo $form->field($model, 'state')->widget(DepDrop::classname(),[
                    		'data'=>$model->statesData,
    'pluginOptions'=>[
        'depends'=>['doctors-country'],
        'placeholder'=>'Select States',
        'url'=>Url::to(['/doctors/doctors/states'])
    ]
]);
     
 ?>  
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
	</div>
	
   
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'pinCode')->textInput(['maxlength' => true]) ?>
    </div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'doctorMobile')->textInput(['maxlength' => 10]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
      <?=$form->field ( $model, 'doctorImage' )->widget ( FileInput::classname (),
   		[ 'options' => [ 'accept' => 'image/*' ],'pluginOptions' =>[[ 'browseLabel' => 'Profile Image', 'allowedFileExtensions'=>['jpg','png','jpeg'] ]] ] )?>
            
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'address')->textarea(['rows' => 4]) ?>
	</div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'summery')->textarea(['rows' => 4]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'APMC')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'TSMC')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
