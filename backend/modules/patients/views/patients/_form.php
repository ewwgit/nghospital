<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\patients\models\Patients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patients-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => 'Select Gender']) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'dateOfBirth')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Your Date of Birth ...' ],'pluginOptions' => [ 'autoclose' => true ] ] ) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
     <?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries']);?>
    </div>
     
       <div class="form-group col-lg-6 col-sm-12">
        <?php echo $form->field($model, 'state')->widget(DepDrop::classname(),[
                    		'data'=>$model->statesData,
    'pluginOptions'=>[
        'depends'=>['patients-country'],
        'placeholder'=>'Select States',
        'url'=>Url::to(['/patients/patients/states'])
    ]
]);
     
 ?> 
     </div>
      
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">

    <?= $form->field($model, 'mandal')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'village')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'pinCode')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardNo')->textInput(['maxlength' => true]) ?>
    </div>
    
  <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'caseNo')->textInput(['maxlength' => true]) ?>
    </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'claimNo')->textInput(['maxlength' => true]) ?>
    </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'IPNo')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'IPRegistrationDate')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter IP Registration Date ...' ],'pluginOptions' => [ 'autoclose' => true ] ] )?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'patientProcedure')->textarea(['rows' => 6]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'caseStatus')->dropDownList([ 'Registered' => 'Registered', 'Processed' => 'Processed', ], ['prompt' => '']) ?>
</div>
  <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardIssuedDate')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Card Issued Date ...' ],'pluginOptions' => [ 'autoclose' => true ] ] ) ?>
   </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'caste')->textInput(['maxlength' => true]) ?>
    </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'relationshipWithFamilyHead')->textInput(['maxlength' => true]) ?>
    </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardHouseNo')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardStreet')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardHamlet')->textInput(['maxlength' => true]) ?>
     </div>
       <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardVillage')->textInput(['maxlength' => true]) ?>
   </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardMandal')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardDistrict')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardConatctNumber')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'cardSourceNumber')->textInput(['maxlength' => true]) ?>
     </div>
       <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'communicationHouseNo')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'communicationStreet')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'communicationHamlet')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'communicationVillage')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'communicationMandal')->textInput(['maxlength' => true]) ?>
   </div>
     <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'communicationDistrict')->textInput(['maxlength' => true]) ?>
    </div>
      <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'communicationSource')->textInput(['maxlength' => true]) ?>
   </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
.help-block {
    height: 5px;
}
</style>
