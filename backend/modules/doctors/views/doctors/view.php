<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//**********************//
use common\models\User;
//**********************//

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->doctorid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->doctorid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
      <?php 
    $usernamedata = User::find()->select(['username','email'])->where(['id'=>$model->doctorid])->one();
    
   // print_r($usernamedata);exit;?>
   <?php if($model->doctorImage != ''){?>
  <?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->doctorImage;?>
						 		
						 		<?php  } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'doctorid',
            'userId',
            'doctorUniqueId',
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
            'name',
            'qualification:ntext',
            'city',
           // 'state',
            'stateName',
          //  'country',
            'countryName',
            'address:ntext',
            'pinCode',
            'doctorMobile',
            'doctorImage',
        		[
        		'attribute'=>'doctorImage',
        		'format' => 'html',
        		'value'=>Html::img($model->doctorImage ? $imgeurl : '/@web/images/user-iconnew.png',['width' => '150px','height' => '150px']),
        		 
        		//'htmlOptions'=>array('width'=>'40px'),
        		],
            'summery:ntext',
            'APMC',
            'TSMC',
            'createdBy',
            'updatedBy',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
