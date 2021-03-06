<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\patients\models\PatientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-index">
<div class="box box-primary">
<div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Patients', ['patientshistorycreate'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        		'patientUniqueId',
            'firstName',
            'lastName',
           // 'gender',
        		[
        		'attribute' => 'gender',
        		'value' => 'gender',
        		'filter' => Html::activeDropDownList($searchModel, 'gender', ['Male' => 'Male','Female' => 'Female'],['class'=>'form-control','prompt' => 'Select Gender']),
        		],
            'age',
            // 'dateOfBirth',
            // 'patientUniqueId',
            // 'country',
            // 'countryName',
            // 'state',
            // 'stateName',
            // 'district',
            // 'city',
            // 'mandal',
            // 'village',
            // 'pinCode',
            // 'mobile',
            // 'createdDate',
            // 'updatedDate',

           ['class' => 'yii\grid\ActionColumn',
           			'header'=>'Action',
           			'headerOptions'=>['style'=>'color:#3c8dbc'],
            		'template' => ' {update} ',
            		'buttons' => [
            				'update' => function ($url,$data) {
            				$url = Url::to(['/patients/patients/patientshistorycreate','id'=>$data->patientUniqueId]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-pencil"></span>',
            						$url,['title'=>'Update']);
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