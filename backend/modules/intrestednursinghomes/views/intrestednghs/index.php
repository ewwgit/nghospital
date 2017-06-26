<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\intrestednursinghomes\models\IntrestednghsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Interested NursingHomes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intrestednghs-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Interested NursingHomes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //'insnghid',
            'name',
            'email:email',
            'role',
            'description:ntext',
            // 'mobile',
            // 'createdDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
