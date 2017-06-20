<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = 'Update Nursings: ' . $model->nursingId;
$this->title = 'Update Nursing Homes';
$this->params['breadcrumbs'][] = ['label' => 'Nursing Homes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->contactPerson, 'url' => ['view', 'id' => $model->nursingId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nursinghomes-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
