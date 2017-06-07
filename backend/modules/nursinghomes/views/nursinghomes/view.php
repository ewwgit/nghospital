<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//**********************//
use common\models\User;
//**********************//

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = $model->nursingId;
$this->params['breadcrumbs'][] = ['label' => 'Nursinghomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursinghomes-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
    $usernamedata = User::find()->select(['username','email'])->where(['id'=>$model->nursingId])->one();
    
   // print_r($usernamedata);exit;?>
    
    

    <?= DetailView::widget([
        'model' => $model,
    	
        'attributes' => [
        		
            'nursingId',
            'nuserId',
            'nurshingUniqueId',
            'contactPerson',
        	//**********************//
        		
        		[
        		'attribute' => 'username',
        	//	'value' => User::getUsername($model->username),
        		'value' =>  $usernamedata['username'],
        		],
        		
        	    [
        		'attribute' => 'email',
        		//'value' => User::getUsername($model->email),
        		'value' =>  $usernamedata['email'],
        		],
        		//**********************//
            'mobile',
            'city',
            'state',
            'stateName',
            'country',
            'countryName',
            'pinCode',
            'address:ntext',
            'description:ntext',
            'createdBy',
            'updatedBy',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>
    

</div>
