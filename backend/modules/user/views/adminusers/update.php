<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdminMaster */

$this->title = 'Update Admin Master: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admin Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-master-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
