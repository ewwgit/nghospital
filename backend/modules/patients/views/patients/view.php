<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\patients\models\Patients */

$this->title = $model->firstName;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->patientId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->patientId], [
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
            'patientId',
            'firstName',
            'lastName',
            'gender',
            'age',
            'dateOfBirth',
            'patientUniqueId',
            'country',
            'countryName',
            'state',
            'stateName',
            'district',
            'city',
            'mandal',
            'village',
            'pinCode',
            'cardNo',
            'mobile',
            'caseNo',
            'claimNo',
            'IPNo',
            'IPRegistrationDate',
            'category',
            'patientProcedure:ntext',
            'caseStatus',
            'cardIssuedDate',
            'caste',
            'occupation',
            'relationshipWithFamilyHead',
            'cardHouseNo',
            'cardStreet',
            'cardHamlet',
            'cardVillage',
            'cardMandal',
            'cardDistrict',
            'cardConatctNumber',
            'cardSourceNumber',
            'communicationHouseNo',
            'communicationStreet',
            'communicationHamlet',
            'communicationVillage',
            'communicationMandal',
            'communicationDistrict',
            'communicationSource',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
