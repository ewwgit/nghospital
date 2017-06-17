<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\qualifications\models\Qualifications */

$this->title = 'Update Qualifications: ' . $model->qlid;
$this->params['breadcrumbs'][] = ['label' => 'Qualifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->qlid, 'url' => ['view', 'id' => $model->qlid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qualifications-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
