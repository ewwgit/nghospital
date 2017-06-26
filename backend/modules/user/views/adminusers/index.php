<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-master-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
        		'attribute'=>'username',
        		'label'=>'User Name',
        		'format'=>'text',
        	],
        	'email:email',
        	[
        		'attribute'=>'role',
        		'label'=>'Role',
        		'format'=>'text',
        	],
        	
        		[
        		'attribute'=>'status',
        		'label'=>'status',
        		'value' => function($data)
        				{
        			if($data->status == 10)
        			{
        				$status = 'Active';
        				
        			}
        			else
        			{
        				$status = 'In-Active';
        			}
        			return $status;
        		}
        		],
           // 'password_reset_token',
            //'auth_key',
            // 'email:email',
            // 'firstName',
            // 'lastName',
            // 'profileImage:ntext',
            // 'roleId',
            // 'status',
            // 'createdDate',
            // 'updatedDate',
            // 'createdBy',
            // 'updatedBy',

            ['class' => 'yii\grid\ActionColumn',
            		'template' => '{view} {update} {delete}{permissions}',
            		'buttons' => [
            				'permissions' => function ($url,$data) {
            				$url = Url::to(['/user/adminusers/permissions','id'=>$data->id]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-user"></span>',
            						$url);
            				},
            		
            				],
            		
            ],
        ],
    ]); ?>

</div>
