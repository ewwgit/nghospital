<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\intresteddoctors\models\IntresteddoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Interested Doctors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intresteddoctors-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Interested Doctors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'name',
            'email:email',
            'mobile',
            // 'mobile',
            // 'createdDate',

            ['class' => 'yii\grid\ActionColumn',
            		'template' => '{view} {update} {delete}{convert}',
            		'buttons' => [
            				'convert' => function ($url,$data) {
            				$url = Url::to(['/intresteddoctors/intresteddoctors/convert-doctors','id'=>$data->insdocid]);
            				return Html::a(
            						'<span class="glyphicon glyphicon-arrow-right"></span>',
            						$url);
            				},
            		
            				],
            		
            ],
        ],
    ]); ?>
</div>
