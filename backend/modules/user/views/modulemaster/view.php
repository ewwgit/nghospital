<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\AdminMaster;

/* @var $this yii\web\View */
/* @var $model app\models\ModulesMaster */

$this->title = 'Modules Master: ' . ' ' . $model->moduleName;
$this->params['breadcrumbs'][] = ['label' => 'Modules Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-master-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'moduleId',
            'moduleName',
            'type',
            'status',
            
        		[
        		'attribute' => 'createdBy',
        		
        		'value' =>  AdminMaster::getUsername($model->createdBy),
        		],
        		
        		[
        				'attribute' => 'UpdatedBy',
        		
        				'value' =>  AdminMaster::getUsername($model->updatedBy),
        		],
        		
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
