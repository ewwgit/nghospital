<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\patients\models\Patients */

$this->title = 'Update Patients: ' . $model->firstName;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->firstName, 'url' => ['view', 'id' => $model->firstName]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patients-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
