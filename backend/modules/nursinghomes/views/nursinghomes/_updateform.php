<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nursinghomes-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'contactPerson')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
   	</div>
   	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'state')->textInput() ?>
   	</div>
   	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'country')->textInput() ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">   
    <?= $form->field($model, 'pinCode')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'address')->textarea(['rows' => 4]) ?>
	</div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
   	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
