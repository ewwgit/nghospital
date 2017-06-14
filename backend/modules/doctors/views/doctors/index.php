<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">

    
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
         //   'doctorUniqueId',
        		[
        		'label' => 'username',
        		'attribute' => 'username',
        		'value' => 'user.username',
        		],
            'name',
            'qualification:ntext',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
