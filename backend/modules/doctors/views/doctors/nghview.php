<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\web\View;
$url = Yii::$app->urlManager->createUrl(['doctors/doctors/nghdetail','nuid'=>$model['nuserId']]);
$imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->nursingImage;
//Yii::$app->urlManager->createUrl(['employees?EmployeeJobsearch%5Bcompany_name%5D='.$model['company_name']]);
/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Nursing Homes List';
//$this->params['breadcrumbs'][] = $this->title;




?>

<style>

li{
list-style-type:none;
margin-bottom:20px;
margin-top:20px;


}


</style>


<div class="col-sm-3">

<ul class="list-group">
  <li class="list-group-item">

 <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
    		[
    		'attribute'=>'nursingImage',
    	    'label'=>' ',
    		'format' => 'html',
    		'value'=>Html::a(Html::img( $imgeurl ,['width' => '150px','height' => '150px']),['doctors/nghdetail','nuid'=>$model->nuserId]),
    		],
    		
    		
    		[
              'attribute' => 'nursingHomeName', 		
               'label'=>" ",
               'format' => 'raw',
                		'value'=>Html::a($model->nursingHomeName,['doctors/nghdetail','nuid'=>$model->nuserId]),
        ],
    		[
    				'attribute'=>'contactPerson',
    	           'label'=>' ',
    				
    				],
    		
    				[
    				'attribute'=>'mobile',
    				'label'=>' ',
    				
    				],

    ],
]); ?> 
</li>
</ul>


</div>

<style>

.table-striped > tbody > tr:nth-of-type(odd) {
      background-color: rgba(249, 249, 249, 0);

}

.table-bordered>tbody>tr>td   {
      border: 1px solid rgba(244, 244, 244, 0.05);
}
</style>
		
   

