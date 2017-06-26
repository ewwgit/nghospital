<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\intrestednursinghomes\models\Intrestednghs */

$this->title = 'Create Interested NursingHomes';
$this->params['breadcrumbs'][] = ['label' => 'Interested NursingHomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intrestednghs-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
