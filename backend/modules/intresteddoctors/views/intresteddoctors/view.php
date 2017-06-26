<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\intresteddoctors\models\Intresteddoctors */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Intresteddoctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intresteddoctors-view">

    

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->insdocid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->insdocid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'insdocid',
            'name',
            'email:email',
            'role',
            'description:ntext',
            'mobile',
            'createdDate',
        ],
    ]) ?>

</div>
