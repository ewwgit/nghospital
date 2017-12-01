<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consultant Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">
<div class="box box-primary">
<div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    	'filterModel' => $search,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          
        		'nursingHomeName',
        		'firstName',
        		'lastName',
        		//'patientRequestStatus',
        		/* [
        		'attribute' => 'patientRequestStatus',
        		'value' => 'patientRequestStatus',
        		'filter' => Html::activeDropDownList($searchModel, 'patientRequestStatus', ['PROCESSING' => 'PROCESSING','COMPLETED' => 'COMPLETED'],['class'=>'form-control','prompt' => 'Status']),
        		], */
        		
        		[
        		'attribute' => 'updatedDate',
        		'label' => 'Date',
        		'value' => 'updatedDate',
        		'filter' => DatePicker::widget([
        				'model' => $search,
        				'attribute' => 'updatedDate',
        				'removeButton' => false,
        				'options' => ['placeholder' => 'Select Date..'],
        				'pluginOptions' => [
        						'autoclose'=>true,
        						'format' => 'yyyy-mm-dd'
        				]
        		]),
        		],

             ['class' => 'yii\grid\ActionColumn',
             		'header'=>'Actions',
             		'headerOptions'=>['style'=>'color:#3c8dbc'],
            		'template' => '{view} ',
             		'buttons' => [
             				'view' => function ($url,$data) {
             				$url = Url::to(['/doctors/doctors/patient-details','phsId'=>$data->patientHistoryId]);
             				return Html::a(
             						'<span class="glyphicon glyphicon-eye-open"></span>',
             						$url,['title'=>'View']);
             				},
             		
             				],
            		
            		
            ],
        ],
    ]); ?>
</div>
</div>
</div>
