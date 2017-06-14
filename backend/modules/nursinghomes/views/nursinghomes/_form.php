<?php
namespace  app\modules\nursinghomes\views;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
//use kartik\widgets\DepDrop;
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
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
   	</div>
   	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'confirmpassword')->passwordInput(['maxlength' => true]) ?>
    </div>
	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 10],['clientOptions' => [
				 'clearIncomplete' => true
		],]) ?>
	</div>
    <div class="form-group col-lg-6 col-sm-12"> 
    <?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries']);?>
    </div>
    <div class="form-group col-lg-6 col-sm-12">
    <?=
    $form->field($model, 'state')->textInput(['maxlength' => true]) 
//      echo $form->field($model, 'state')->widget(DepDrop::classname(),[
//                     		'data'=>$model->statesData,
//     'pluginOptions'=>[
//         'depends'=>['nursinghomes-country'],
//         'placeholder'=>'Select States',
//         'url'=>Url::to(['/nursinghomes/nursinghomes/states'])
//     ]
// ]);
    
      
 ?>  
 	</div>
 	<div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
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
