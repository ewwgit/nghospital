<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NursinghomesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Nursinghomes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursinghomes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nursinghomes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php  $username = User::find ()->select ( 'username' )->all (); 
   
            $var = array($username);
          // print_r($var);
    
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nursingId',
        		//'username',
        		[
        		'label' => 'username',
        		'attribute' => 'username',
        		'value' => 'user.username',
        		],
//         		'email',
           //  'nuserId',
           // 'nurshingUniqueId',
            'contactPerson',
            'mobile',
             'city',
            // 'state',
             'stateName',
            // 'country',
             'countryName',
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
