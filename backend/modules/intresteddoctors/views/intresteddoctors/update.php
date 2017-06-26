<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\intresteddoctors\models\Intresteddoctors */

$this->title = 'Update Interested Doctors: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Intresteddoctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->insdocid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="intresteddoctors-update">
  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
