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
 
    <?= $form->field($model, 'contactPerson')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'confirmpassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 10]) ?>
        
    <?= $form->field($model, 'country')->dropDownList($model->countriesList,['prompt'=>'Select Countries']);?>
          
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
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'pinCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
