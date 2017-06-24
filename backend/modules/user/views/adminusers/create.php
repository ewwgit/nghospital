<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdminMaster */

$this->title = 'Create Admin Master';
$this->params['breadcrumbs'][] = ['label' => 'Admin Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-master-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
