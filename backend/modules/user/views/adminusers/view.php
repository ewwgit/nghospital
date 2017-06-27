<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AdminMaster */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-master-view">  

     <?php if($model->status == 10){
    $status = 'Active';
    }
    else {
    	$status = 'In-Active';
    }?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'email:email',
            'firstName',
            'lastName',
        	'phoneNumber',
        	'address',
        	
           // 'role.RoleName',
        		['attribute'=>'role.RoleName',
        		'label' => 'Role Name',],
        		[
        		'attribute'=>'status',
        		'value'=> $status,
        		],
        		['attribute'=>'profileImage',
        		'format' => 'html',
        		'value'=>Html::img($model->profileImage ? $model->profileImage : '@web',['width' => '150px']),
        		
        		//'htmlOptions'=>array('width'=>'40px'),
        		],
        		 
           
           // 'createdBy',
           // 'updatedBy',
        ],
    ]) ?>
</div>
