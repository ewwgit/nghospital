<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\date\DatePicker;
use app\modules\patients\models\DoctorNghPatient;
use app\modules\doctors\models\Doctors;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Previous Records';
$this->params['breadcrumbs'][] = $this->title;
//$sdata = User::find()->select('status')->all();
//$data = $sdata->status;
?>
<div class="doctors-index">
<div class="box box-primary">
<div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  
<?= GridView::widget([
        'dataProvider' => $dataProvider,
    	'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       			 [
        		'attribute' =>'name',
       			 		'label'=>'Doctor Name',
       			 		'headerOptions'=>['style'=>'color:#3c8dbc'],
        		],
        		[
        		'attribute' => 'createdDate',
        		'label' => 'Date',
        		
        		'value' => 'createdDate',
        			/*'value'=>	function ($dataProvider) {
        					return Html::a($dataProvider->createdDate,['/doctors/doctors/patientshistoryview','infoid'=>$dataProvider->patientInfoId]);
        				},*/
        		'filter' => DatePicker::widget([
        				'model' => $searchModel,
        				'attribute' => 'createdDate',
        				'removeButton' => false,
        				'options' => ['placeholder' => 'Select Date..'],
        				'pluginOptions' => [
        						'autoclose'=>true,
        						'format' => 'yyyy-mm-dd'
        				],
        				
        		]),
        				],
        		 ['class' => 'yii\grid\ActionColumn',
             		'header'=>'Actions',
             		'headerOptions'=>['style'=>'color:#3c8dbc'],
            		'template' => '{view} ',
             		'buttons' => [
             				'view' => function ($url,$data) {
             				$url = Url::to(['/doctors/doctors/patientshistoryview','infoid'=>$data->patientInfoId]);
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

