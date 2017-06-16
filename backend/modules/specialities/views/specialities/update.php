<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\specialities\models\Specialities */

$this->title = 'Update Specialities: ' . $model->spId;
$this->params['breadcrumbs'][] = ['label' => 'Specialities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->spId, 'url' => ['view', 'id' => $model->spId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="specialities-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
