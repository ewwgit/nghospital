<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//**********************//
use common\models\User;
use app\modules\nursinghomes\models\Nursinghomes;
//**********************//

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = $model->nursingId;
$this->title = ' Nursing Homes View';
$this->params['breadcrumbs'][] = ['label' => 'Nursing Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursinghomes-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->nursingId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->nursingId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php 
    $usernamedata = User::find()->select(['username','email'])->where(['id'=>$model->nuserId])->one();
    
 //  print_r(Yii::$app->user->identity->username);exit;?>
    
    

    <?= DetailView::widget([
        'model' => $model,
    	
        'attributes' => [
        		
            'nursingId',
           // 'nuserId',
//         		[
//         		'attribute'=>'nuserId',
//         		'label' => 'UserName',
        		       		
//         		],
           // 'nurshingUniqueId',
            'contactPerson',
        	//**********************//
        		[
        		'attribute' => 'username',
        	    //'value' => User::getUsername($model->username),
        		'value' =>  $usernamedata['username'],
        		],
        		
        	    [
        		'attribute' => 'email',
        		//'value' => User::getUsername($model->email),
        		'value' =>  $usernamedata['email'],
        		],
        		//**********************//
                'mobile',
        		'landline',
        		[
        		        		'attribute'=>'countryName',
        		        		'label' => 'Country',
        			   		],
        		[
        		'attribute'=>'stateName',
        		'label' => 'State',
        		 
        		],
            'city',
           // 'state',
          
           // 'country',
           
            'pinCode',
            'address:ntext',
            'description:ntext',
        		
        	[
        		'attribute' => 'createdBy',
        		
        		'value' =>  Nursinghomes::getUsername($model->createdBy),
        		],
        		
        		[
        		'attribute' => 'updatedBy',
        		
        		'value' =>  Nursinghomes::getUsername($model->updatedBy),
        		],
//         		'createdBy',
//         		'updatedBy',
         
            'createdDate',
            'updatedDate',
        ],
    ]) ?>
    

</div>
