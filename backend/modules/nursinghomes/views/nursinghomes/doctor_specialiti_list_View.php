<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\specialities\models\Specialities;

?>
<?php 
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-4 ">
<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
				[ 
				//'attribute' => 'specialityName',
				'label' => 'specialityName',
 				'value' =>Html::a($model->specialityName,['nursinghomes/specialitibaseddoctorlist','id' => $model->spId]),
 				'format' => 'raw',
				],
				],
]) ?></div>