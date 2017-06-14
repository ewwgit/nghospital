<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
   

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qualification')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput() ?>

    

    <?= $form->field($model, 'country')->textInput() ?>

   

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pinCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctorMobile')->textInput(['maxlength' => true]) 

    // $form->field($model, 'doctorImage')->textInput() ?>
     <?php if($model->doctorImage != ''){?>
    
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
            
            
        
               

    <?= $form->field($model, 'summery')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'APMC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TSMC')->textInput(['maxlength' => true]) ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
