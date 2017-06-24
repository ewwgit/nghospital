<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModulesMaster */

$this->title = 'Update Modules Master: ' . ' ' . $model->moduleName;
$this->params['breadcrumbs'][] = ['label' => 'Modules Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->moduleName, 'url' => ['view', 'id' => $model->moduleId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modules-master-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
