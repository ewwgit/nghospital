<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NursinghomesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<h1 ><?php $this->title = 'Nursings';?></h1>
<?php 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursinghomes-index">

    <h1><?php //Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nursing Homes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
 
   
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
           // 'nurshingUniqueId',
            'contactPerson',
            'mobile',
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
            // 'address:ntext',
            // 'description:ntext',
            // 'createdBy',
            // 'updatedBy',
            // 'createdDate',
            // 'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
