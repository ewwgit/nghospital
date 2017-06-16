<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nursinghomes */


$this->title = 'Create Nursings';

$this->params['breadcrumbs'][] = ['label' => 'Nursings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// Html::encode($this->title)
?>
<div class="nursinghomes-create">

    <h1> </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
