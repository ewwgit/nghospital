<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */

//$this->title = 'Create Nursinghomes';
$this->params['breadcrumbs'][] = ['label' => 'Nursinghomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursinghomes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
