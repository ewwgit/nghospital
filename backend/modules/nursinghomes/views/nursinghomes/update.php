<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = 'Update Nursinghomes: ' . $model->nursingId;
$this->params['breadcrumbs'][] = ['label' => 'Nursinghomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nursingId, 'url' => ['view', 'id' => $model->nursingId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nursinghomes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
