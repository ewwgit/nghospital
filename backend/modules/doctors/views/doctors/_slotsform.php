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
        				//'00:30' => '00:30 PM',
        				'01:00' => '01:00 AM',
        				'01:30' => '01:30 AM',
        				'02:00' => '02:00 AM',
        				'02:30' => '02:30 AM',
        				'03:00' => '03:00 AM',
        				'03:30' => '03:30 AM',
        				'04:00' => '04:00 AM',
        				'04:30' => '04:30 AM',
        				'05:00' => '05:00 AM',
        				'05:30' => '05:30 AM',
        				'06:00' => '06:00 AM',
        				'06:30' => '06:30 AM',
        				'07:00' => '07:00 AM',
        				'07:30' => '07:30 AM',
        				'08:00' => '08:00 AM',
        				'08:30' => '08:30 AM',
        				'09:00' => '09:00 AM',
        				'09:30' => '09:30 AM',
        				'10:00' => '10:00 AM',
        				'10:30' => '10:30 AM',
        				'11:00' => '11:00 AM',
        				'11:30' => '11:30 AM',
        				'12:00' => '12:00 AM',
        				'12:30' => '12:30 AM',
        				
    					'01:00' => '01:00 PM',
    					'01:30' => '01:30 PM',
    					'02:00' => '02:00 PM',
    					'02:30' => '02:30 PM',
    					'03:00' => '03:00 PM',
    					'03:30' => '03:30 PM',
    					'04:00' => '04:00 PM',
    					'04:30' => '04:30 PM',
    					'05:00' => '05:00 PM',
    					'05:30' => '05:30 PM',
    					'06:00' => '06:00 PM',
    					'06:30' => '06:30 PM',
    					'07:00' => '07:00 PM',
    					'07:30' => '07:30 PM',
    					'08:00' => '08:00 PM',
    					'08:30' => '08:30 PM',
    					'09:00' => '09:00 PM',
    					'09:30' => '09:30 PM',
    					'10:00' => '10:00 PM',
    					'10:30' => '10:30 PM',
    					'11:00' => '11:00 PM',
    					'11:30' => '11:30 PM',
    					'12:00' => '12:00 PM',
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
    						//'00:30' => '00:30 PM',
        				'01:00' => '01:00 AM',
        				'01:30' => '01:30 AM',
        				'02:00' => '02:00 AM',
        				'02:30' => '02:30 AM',
        				'03:00' => '03:00 AM',
        				'03:30' => '03:30 AM',
        				'04:00' => '04:00 AM',
        				'04:30' => '04:30 AM',
        				'05:00' => '05:00 AM',
        				'05:30' => '05:30 AM',
        				'06:00' => '06:00 AM',
        				'06:30' => '06:30 AM',
        				'07:00' => '07:00 AM',
        				'07:30' => '07:30 AM',
        				'08:00' => '08:00 AM',
        				'08:30' => '08:30 AM',
        				'09:00' => '09:00 AM',
        				'09:30' => '09:30 AM',
        				'10:00' => '10:00 AM',
        				'10:30' => '10:30 AM',
        				'11:00' => '11:00 AM',
        				'11:30' => '11:30 AM',
        				'12:00' => '12:00 AM',
        				'12:30' => '12:30 AM',
    						
    					'01:00' => '01:00 PM',
    					'01:30' => '01:30 PM',
    					'02:00' => '02:00 PM',
    					'02:30' => '02:30 PM',
    					'03:00' => '03:00 PM',
    					'03:30' => '03:30 PM',
    					'04:00' => '04:00 PM',
    					'04:30' => '04:30 PM',
    					'05:00' => '05:00 PM',
    					'05:30' => '05:30 PM',
    					'06:00' => '06:00 PM',
    					'06:30' => '06:30 PM',
    					'07:00' => '07:00 PM',
    					'07:30' => '07:30 PM',
    					'08:00' => '08:00 PM',
    					'08:30' => '08:30 PM',
    					'09:00' => '09:00 PM',
    					'09:30' => '09:30 PM',
    					'10:00' => '10:00 PM',
    					'10:30' => '10:30 PM',
    					'11:00' => '11:00 PM',
    					'11:30' => '11:30 PM',
    					'12:00' => '12:00 PM',
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