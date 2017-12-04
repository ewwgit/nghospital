<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NursinghomesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<h1 ><?php $this->title = 'Nursing Homes';?></h1>
<?php 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursinghomes-index">
<div class="box box-primary">
<div class="box-body">
    <h1><?php //Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nursing Homes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
     <?php  $data = User::find()->select('status')->all (); 
   
         //   $var = array($status);
        //   print_r($data);exit;
    
    ?>
 
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'nursingId',
        		//'username',
        		[
        		'label' => 'User Name',
        		'attribute' => 'username',
        		'value' => 'user.username',
        		],
//         		'email',
           //  'nuserId',
          //  'nurshingUniqueId',
        		[
        		'attribute'=>'nurshingUniqueId',
        		'label' => 'Unique Id',
        		],
            'contactPerson',
          
        		[
        		'attribute'=>'mobile',
        		'label' =>   'Mobile Number',
        		],
        	//	'countryName',
        	[
        		'attribute'=>'countryName',
        		 'label' => 'Country',
        			],
        	//	'stateName',
        		[
        		'attribute'=>'stateName',
        		'label' => 'State',
        		 
        		],
             'city',
            // 'state',
          
            // 'country',
            
             'pinCode',
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


        		

        		//'status',
            // 'address:ntext',
            // 'description:ntext',
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
            				$url = Url::to(['/nursinghomes/nursinghomes/reset-password','id'=>$data->nuserId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-lock"></span>',
            						$url,['title'=>'Reset Password']);
            				},
            				'delete' => function ($url,$data) {
            				$url = Url::to(['/nursinghomes/nursinghomes/delete','id'=>$data->nuserId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-trash"></span>',
            						$url,['title'=>'Delete','aria-label' => 'Delete', 'data-pjax' => '0','data-confirm'=>'Are you sure you want to delete this item?','data-method' => 'post']);
            				},
            				'reports' => function ($url,$data){
            				$url = Url::to(['/nursinghomes/nursinghomes/patient-consultant-report','id'=>$data->nuserId]);
            				return Html::a('<span class="glyphicon glyphicon-certificate"></span>',$url,(['title'=>'Reports']));
            				},
            				'excel-sheet'=>function($url,$data)
            				{
            					$url=Url::to(['/nursinghomes/nursinghomes/nursinghomes-consultant-report-excel','id'=>$data->nuserId]);
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