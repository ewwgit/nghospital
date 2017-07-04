<?php

use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = 'Patients History';
$this->params['breadcrumbs'][] = $this->title;

$items = [
		[
				'label'=>'<i class="fa fa-map-marker"></i> IP',
				'content'=>'IP Address',
				'active'=>true,
		],
		[
				'label'=>'<i class="fa fa-history"></i> Past History',
				'content'=>'Past History',
		],
		[
				'label'=>'<i class="fa fa-paperclip"></i> Attachments',
				'content'=>'Attachments',
		],
		[
				'label'=>'<i class="fa fa-sticky-note-o"></i> Clinical Notes',
				'content'=>'Clinical Notes',
		],
		[
				'label'=>'<i class="fa fa-info"></i> Pre Auth Details',
				'content'=>'Pre Auth Details',
		],
		[
				'label'=>'<i class="fa fa-user-secret"></i> Fraud/CR',
				'content'=>'Fraud/CR',
		],
		
];
?>
<div class="box box-primary">
<div class="box-body">
<?php $form = ActiveForm::begin(['options'=>['enctype' =>'multipart/form-data']]); ?>
<div class="form-group col-lg-12 col-sm-12" style="border-bottom: 1px solid #ccc;">
<div class="form-group col-lg-4 col-sm-12" style="padding-left: 0px;">
    <div class="form-group col-lg-4 col-sm-12">First Name:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Last Name:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Gender:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Age:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Date of Birth:</div> <div class="col-lg-8 col-sm-12"><input type="text"></div>
</div>
<div class="form-group col-lg-4 col-sm-12" style="padding-left: 0px;">
    <div class="form-group col-lg-4 col-sm-12">Country:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">State:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">District:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">City:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Mandal:</div> <div class="col-lg-8 col-sm-12"><input type="text"></div>
</div>
<div class="form-group col-lg-4 col-sm-12" style="padding-left: 0px;">
    <div class="form-group col-lg-4 col-sm-12">Village:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Pin Code:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Mobile:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Image:</div> <div class="form-group col-lg-8 col-sm-12"><input type="file" name="Browse"></div>
</div>
</div>
<div class="form-group col-lg-12 col-sm-12" style="border-bottom: 1px solid #ccc;">
<?php 
// Ajax Tabs Above
echo TabsX::widget([
		'items'=>$items,
		'position'=>TabsX::POS_ABOVE,
		'encodeLabels'=>false
]);
?>
</div>
<div class="form-group col-lg-12 col-sm-12">
<div class="form-group col-lg-4 col-sm-12" style="padding-left: 0px;">
    <div class="form-group col-lg-4 col-sm-12">Height:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Weight:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Resp Rate:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Pulse Rate:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    
</div>
<div class="form-group col-lg-4 col-sm-12" style="padding-left: 0px;">
    <div class="form-group col-lg-4 col-sm-12">BpLeft Arm:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">BPRight Arm:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Temp Type:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    <div class="form-group col-lg-4 col-sm-12">Diseases:</div> <div class="form-group col-lg-8 col-sm-12"><input type="text"></div>
    
    
</div>
<div class="form-group col-lg-4 col-sm-12" style="padding-left: 0px;">
<div class="form-group col-lg-4 col-sm-12">Compliant:</div> <div class="form-group col-lg-8 col-sm-12"><textarea></textarea></div>
    <div class="form-group col-lg-4 col-sm-12">Document:</div> <div class="form-group col-lg-8 col-sm-12"><input type="file" name="Browse"></div>
    <div class="form-group col-lg-4 col-sm-12">Allergic Medicine:</div> <div class="col-lg-8 col-sm-12"><input type="text"></div>
</div>
</div>
<?php ActiveForm::end(); ?>
</div>
</div>