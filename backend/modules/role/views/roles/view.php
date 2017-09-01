<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */
$str = $model->RoleName;
$rest = substr($str, 0, 150);

$this->title = $rest;

//$this->title = $model->RoleName;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-view">
<div class="box box-primary">
<div class="box-body">
<p>
        <?= Html::a('Update', ['update', 'id' => $model->RoleId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->RoleId], [
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
            
            'RoleName',
            'status',
            'description:ntext',
            [
        		'attribute' => 'createdDate',
        		
        		'format' =>  ['date', 'php:m/d/Y H:i:s'],
        		],
        		[
        		'attribute' => 'updatedDate',
        		
        		'format' =>  ['date', 'php:m/d/Y H:i:s'],
        		],
            'ipAddress',
        ],
    ]) ?>
</div>
</div>
</div>
<style>
.detail-view td {
   max-width: 50px;
    
    word-wrap: break-word;
}

.detail-view th {
   max-width: 10px;
   
    word-wrap: break-word;
}
</style>
