<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\intrestednursinghomes\models\Intrestednghs */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Interested Nursing Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intrestednghs-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->insnghid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->insnghid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //'insnghid',
            'name',
            //'email:email',
        		[
        		'attribute'=>'email',
        		'value' => $model->email,
        		//'format' => 'raw',
        		],
            'role',
            'description:ntext',
            'mobile',
            'createdDate',
        ],
    ]) ?>

</div>
