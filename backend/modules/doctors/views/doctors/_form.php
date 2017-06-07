<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\doctors\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->textInput() ?>

    <?= $form->field($model, 'doctorUniqueId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password')->passwordInput()?>
    
    <?= $form->field($model, 'confirmpassword')->passwordInput()?>
      
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'stateName')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'countryName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pinCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctorMobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctorImage')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'summery')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'APMC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TSMC')->textInput(['maxlength' => true]) ?>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
