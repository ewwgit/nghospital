<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\specialities\models\Specialities */

$this->title = $model->specialityName;
$this->params['breadcrumbs'][] = ['label' => 'Specialities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialities-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->spId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->spId], [
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
            'spId',
            'specialityName',
            'specialityCode',
            'description:ntext',
            'status',
            'createdBy',
            'updatedBy',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
