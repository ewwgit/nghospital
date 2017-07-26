<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\DoctorsSpecialities;
use app\modules\doctors\models\Doctors;
use app\modules\specialities\models\Specialities;

?>
	<?php $doctordata = Doctors::find()->select(['name','doctorMobile','doctorImage'])->where(['userId'=>$model->rdoctorId])->one();
	       if($doctordata->doctorImage != ''){
					 $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$doctordata->doctorImage;
					 } ?>
 
<div class="form-group col-lg-3 col-sm-12">
  <div >
  <ul class="list-group">
  <li class="list-group-item">
  <?= DetailView::widget([
		'model' => $model,
		'attributes' => [
				//'spId',

				[
				'attribute'=>'doctorImage',
				'format' => 'html',
				//'value'=>Html::img($doctordata->doctorImage ? $imgeurl : 'images/user-iconnew.png',['width' => '275px','height' => '150px']),
				'value'=> Html::a(Html::img($doctordata->doctorImage  ? $imgeurl : 'images/user-iconnew.png', ['width' => '190px','height' => '150px']), [ 'nursinghomes/doctorview', 'id' => $model->rdoctorId]),		
				],
				[
				'attribute' => 'Doctorname',
				'value' =>Html::a(Doctors::getDoctorname($model->rdoctorId),['nursinghomes/doctorview','id' => $model->rdoctorId]),
				'format' => 'raw',
                 ],
				[
				'attribute'=>'doctorMobile',
				'format' => 'html',
				'value'=>$doctordata->doctorMobile ,
				],
				
				[
				'attribute'=>'Speciality',
				'value' =>  Specialities::getSpname($model->rspId),
				
				],
				
				

				
				
		],
]) ?></li></ul>
</div>
</div>
<style>
.table-striped > tbody > tr:nth-of-type(odd) {
    background-color: rgba(249, 249, 249, 0);
}
 .table-bordered>tbody>tr>td  {
    border: 1px solid rgba(244, 244, 244, 0.05);
}
</style>



