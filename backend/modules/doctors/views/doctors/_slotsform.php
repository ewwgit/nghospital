<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-form">

<div class="box box-primary">
<div class="box-body"> 


   
    <?php $form = ActiveForm::begin([
    'enableAjaxValidation'      => true,
    'enableClientValidation'    => false,
    'validateOnChange'          => false,
    'validateOnSubmit'          => true,
    'validateOnBlur'            => false,
]);?>
    
    <div class="form-group col-lg-6 col-sm-12">
    <?= $form->field($model, 'slotsInfo')->widget(MultipleInput::className(), [
		/* 'rendererClass' => \unclead\multipleinput\renderers\ListRenderer::className(), */
    'max' => 7,
	'id' => 'multiple-input',
    'columns' => [
        
    		[
    		'name' => 'docslotId',
    		'type' => 'hiddenInput'
    		],
        [
            'name'  => 'day',
            'title' => 'Day',
        	'type'  => 'dropDownList',
            'enableError' => true,
        		
        		'items' => [
        				'MONDAY' => 'MONDAY',
        				'TUESDAY' => 'TUESDAY',
        				'WEDNESDAY' => 'WEDNESDAY',
        				'THURSDAY' => 'THURSDAY',
        				'FRIDAY' => 'FRIDAY',
        				'SATURDAY' => 'SATURDAY',
        				'SUNDAY' => 'SUNDAY',
        		],
            'options' => [
                'class' => 'input-day',
            	'prompt'=>'Select Day'
            	
            ]
        ],
        [
        'name'  => 'startTime',
        'title' => 'Start Time',
        'type'  => 'dropDownList',
        'enableError' => true,
        		
        		'items' => [
        				'09:00' => '09:00 AM',
        				'09:30' => '09:30 AM',
        				'10:00' => '10:00 AM',
        				'10:30' => '10:30 AM',
        				'11:00' => '11:00 AM',
        				'11:30' => '11:30 AM',
        				'12:00' => '12:00 AM',
        				'12:30' => '12:30 PM',
        				
        		],
        'options' => [
        		'class' => 'input-starttime',
        		'maxlength' => 125,
        		'prompt'=>'Select Start Time'
        ]
        ],
    		[
    		'name'  => 'endTime',
    		'title' => 'End Time',
    				'type'  => 'dropDownList',
    		'enableError' => true,
    			
    				'items' => [
    						'09:00' => '09:00 AM',
    						'09:30' => '09:30 AM',
    						'10:00' => '10:00 AM',
    						'10:30' => '10:30 AM',
    						'11:00' => '11:00 AM',
    						'11:30' => '11:30 AM',
    						'12:00' => '12:00 AM',
    						'12:30' => '12:30 PM',
    				],
    		'options' => [
    				'class' => 'input-endtime',
    				'maxlength' => 20,
    				'prompt'=>'Select End Time'
    		]
    		],
    		
    ]
 ])->label(false);
?>
	</div>
	 
	
	<div class="form-group col-lg-6 col-sm-12 " >
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
<style>
.help-block {
    height: 5px;
}
.select2-search__field {
	display: none;
}
</style>