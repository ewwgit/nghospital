<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">
<div class="box box-primary">
<div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doctors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
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
             'stateName',
            // 'country',
             'countryName',
            // 'address:ntext',
             'pinCode',
             'doctorMobile',
            // 'doctorImage',
            // 'summery:ntext',
            // 'APMC',
            // 'TSMC',
            // 'createdBy',
            // 'updatedBy',
            // 'createdDate',
            // 'updatedDate',

             ['class' => 'yii\grid\ActionColumn',
            		'template' => '{view} {update} {delete}{password}',
            		'buttons' => [
            				'password' => function ($url,$data) {
            				$url = Url::to(['/doctors/doctors/reset-password','id'=>$data->userId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-lock"></span>',
            						$url);
            				},
            				'delete' => function ($url,$data) {
            				$url = Url::to(['/doctors/doctors/delete','id'=>$data->userId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-trash"></span>',
            						$url,['title'=>'Delete','aria-label' => 'Delete', 'data-pjax' => '0','data-confirm'=>'Are you sure you want to delete this item?','data-method' => 'post']);
            				},
            		
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
