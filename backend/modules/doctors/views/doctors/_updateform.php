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

    <?php $form = ActiveForm::begin(); ?>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
   	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'qualification')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
   <?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries']);
   
   //  $form->field($model, 'country')->textInput() ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
   <?php
 //   $form->field($model, 'state')->textInput(['maxlength' => true]) 
     echo $form->field($model, 'state')->widget(DepDrop::classname(),[
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
    <?= $form->field($model, 'doctorMobile')->textInput(['maxlength' => true]) 

    // $form->field($model, 'doctorImage')->textInput() ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?php if($model->doctorImage != ''){?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->doctorImage;?>

						 		
						 		<?php  }
						 		// print_r($imgeurl);exit;?>

						<h5>Upload Your Profile Image</h5>
						<img class='image' 
							src="<?php
							if($model->doctorImage)
							{
								
								echo isset( $model->doctorImage)? Url::base().$model->doctorImage : '' ;
							
							}else {
									 echo Url::base()."/images/user-iconnew.png" ;
								      }
								?>"
							width="100" height="100"> </img> 
							 <?=$form->field ( $model, 'doctorImage' )->widget ( FileInput::classname (), [ 'options' => [ 'accept' => 'image/*' ],'pluginOptions' =>[[ 'browseLabel' => 'doctorImage', 'allowedFileExtensions'=>['jpg','png','jpeg'] ]] ] )?>
            
            
        
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
