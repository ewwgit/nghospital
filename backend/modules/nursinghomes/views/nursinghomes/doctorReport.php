<?php
use yii\helpers\html;
use yii\grid\GridView;
use yii\helpers\url;
use kartik\date\DatePicker;


$this->title = 'Doctor Report';
$this->params['breadcrumbs'][]=$this->title;
?>
<div class="doctors-index">
	<div class="box box-primary">
		<div class="box-body">
		<?= GridView::widget([
				'filterModel'=>$searchModel,
				'dataProvider'=>$dataProvider,
				'columns'=>[
						['class' => 'yii\grid\SerialColumn'],
						[
								'attribute'=>'firstName',
								'label'=>'Patient Name',
								'value'=>function($data)
								{
							return $data->firstName . "" . $data->lastName;
						},
								'headerOptions'=>['style'=>'color:#3c8dbc'],
						],
						[
								'attribute'=>'name',
								'label'=>'Doctor Name',
								'headerOptions'=>['style'=>'color:#3c8dbc'],
						],
						[
								'headerOptions'=>['style'=>'color:#3c8dbc'],
							'attribute'=>'updatedDate',
							'label'=>'Prescription Date',
								'value' => 'updatedDate',
        						'filter' => DatePicker::widget([
        						'model'=>$searchModel,
        						'attribute' => 'updatedDate',
        						'removeButton' => false,
        						'options' => ['placeholder' => 'Select Date..'],
        							'pluginOptions' => [
        							'autoclose'=>true,
        						'format' => 'yyyy-mm-dd'
        				]
        				]),
				]
		]
		])?>
		</div>
	</div>
</div>