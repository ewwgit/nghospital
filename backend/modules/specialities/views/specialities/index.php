<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\specialities\models\SpecialitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Specialities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialities-index">
<div class="box box-primary">
<div class="box-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Specialities', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'spId',
            'specialityName',
            'specialityCode',
            'description:ntext',
           // 'status',
        		[
        		'attribute' => 'status',
        		'value' => 'status',
        		'filter' => Html::activeDropDownList($searchModel, 'status', ['Active' => 'Active','In-active' => 'In-active'],['class'=>'form-control','prompt' => 'Status']),
        		],
            // 'createdBy',
            // 'updatedBy',
            // 'createdDate',
            // 'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>