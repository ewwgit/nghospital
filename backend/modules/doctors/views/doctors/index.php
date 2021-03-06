<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors';
$this->params['breadcrumbs'][] = $this->title;
//$sdata = User::find()->select('status')->all();
//$data = $sdata->status;
?>
<div class="doctors-index">
<div class="box box-primary">
<div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doctors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    
       GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'doctorid',
          //  'userId',
            'doctorUniqueId',
        		[
        		'label' => 'User Name',
        		'attribute' => 'username',
        		'value' => 'user.username',
        		],
            'name',
            //'qualification:ntext',
            // 'city',
            // 'state',
        		[
        		'label' => 'Country',
        		'attribute' => 'countryName',
        		],
        		[
        		'label' => 'State',
        		'attribute' =>'stateName',
        		],
        		
        		
             
            // 'country',
             
            // 'address:ntext',
        	
             	[
        		'label' => 'Mobile Number',
        		'attribute' => 'doctorMobile',
        		],
        		['attribute'=>'status',
        		'label' => 'Status',
        		'value' => function ($data) {
        		if($data->user->status == 10)
        		{
        			return 'Active';
        		}
        		else 
        		{
        			return 'In-active';
        		}
        		},
        		'filter' => Html::activeDropDownList($searchModel, 'status', ['10' => 'Active','0' => 'In-active'],['class'=>'form-control','prompt' => 'Status']),
        		],
        		
        		
        		
        		
        		
            // 'doctorImage',
            // 'summery:ntext',
            // 'APMC',
            // 'TSMC',
            // 'createdBy',
            // 'updatedBy',
            // 'createdDate',
            // 'updatedDate',

             ['class' => 'yii\grid\ActionColumn',
             		'header'=>'Actions',
             		'headerOptions'=>['style'=>'color:#3c8dbc'],
            		'template' => '{view} {update} {delete}  {password} {reports} {excel-sheet}',
            		'buttons' => [
            				'password' => function ($url,$data) {
            				$url = Url::to(['/doctors/doctors/reset-password','id'=>$data->userId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-lock"></span>',
            						$url,['title'=>'Reset Password']);
            				},
            				'delete' => function ($url,$data) {
            				$url = Url::to(['/doctors/doctors/delete','id'=>$data->userId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-trash"></span>',
            						$url,['title'=>'Delete','aria-label' => 'Delete', 'data-pjax' => '0','data-confirm'=>'Are you sure you want to delete this item?','data-method' => 'post']);
            				},
            				'reports' => function ($url,$data) {
            				$url = Url::to(['/doctors/doctors/patient-consultant-report','id'=>$data->userId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-certificate"></span>',
            						$url,['title'=>'Reports']);
            				 
            				},
            				'excel-sheet'=>function($url,$data)
            				{
            					$url=Url::to(['/doctors/doctors/doctors-consultant-report-excel','id'=>$data->userId]);
            					return Html::a('<span class="glyphicon glyphicon-download"></span>',$url,(['title'=>'Excel Sheet']));
            				}
            				],
            		
            ],
        ],
    ]); ?>
</div>
</div>
</div>
<style>
.grid-view td {
    max-width: 100px;
    overflow: auto; /* optional */
    word-wrap: break-word;
}
</style>
