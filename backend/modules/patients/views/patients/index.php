<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\patients\models\PatientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Patients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        		'patientUniqueId',
            'firstName',
            'lastName',
            'gender',
            'age',
            // 'dateOfBirth',
            // ,
            // 'country',
            // 'countryName',
            // 'state',
            // 'stateName',
            // 'district',
            // 'city',
            // 'mandal',
            // 'village',
            // 'pinCode',
            // 'cardNo',
            // 'mobile',
            // 'caseNo',
            // 'claimNo',
            // 'IPNo',
            // 'IPRegistrationDate',
            // 'category',
            // 'patientProcedure:ntext',
            // 'caseStatus',
            // 'cardIssuedDate',
            // 'caste',
            // 'occupation',
            // 'relationshipWithFamilyHead',
            // 'cardHouseNo',
            // 'cardStreet',
            // 'cardHamlet',
            // 'cardVillage',
            // 'cardMandal',
            // 'cardDistrict',
            // 'cardConatctNumber',
            // 'cardSourceNumber',
            // 'communicationHouseNo',
            // 'communicationStreet',
            // 'communicationHamlet',
            // 'communicationVillage',
            // 'communicationMandal',
            // 'communicationDistrict',
            // 'communicationSource',
            // 'createdDate',
            // 'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
