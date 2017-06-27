<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\patients\models\PatientsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'patientId') ?>

    <?= $form->field($model, 'firstName') ?>

    <?= $form->field($model, 'lastName') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'dateOfBirth') ?>

    <?php // echo $form->field($model, 'patientUniqueId') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'countryName') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'stateName') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'mandal') ?>

    <?php // echo $form->field($model, 'village') ?>

    <?php // echo $form->field($model, 'pinCode') ?>

    <?php // echo $form->field($model, 'cardNo') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'caseNo') ?>

    <?php // echo $form->field($model, 'claimNo') ?>

    <?php // echo $form->field($model, 'IPNo') ?>

    <?php // echo $form->field($model, 'IPRegistrationDate') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'patientProcedure') ?>

    <?php // echo $form->field($model, 'caseStatus') ?>

    <?php // echo $form->field($model, 'cardIssuedDate') ?>

    <?php // echo $form->field($model, 'caste') ?>

    <?php // echo $form->field($model, 'occupation') ?>

    <?php // echo $form->field($model, 'relationshipWithFamilyHead') ?>

    <?php // echo $form->field($model, 'cardHouseNo') ?>

    <?php // echo $form->field($model, 'cardStreet') ?>

    <?php // echo $form->field($model, 'cardHamlet') ?>

    <?php // echo $form->field($model, 'cardVillage') ?>

    <?php // echo $form->field($model, 'cardMandal') ?>

    <?php // echo $form->field($model, 'cardDistrict') ?>

    <?php // echo $form->field($model, 'cardConatctNumber') ?>

    <?php // echo $form->field($model, 'cardSourceNumber') ?>

    <?php // echo $form->field($model, 'communicationHouseNo') ?>

    <?php // echo $form->field($model, 'communicationStreet') ?>

    <?php // echo $form->field($model, 'communicationHamlet') ?>

    <?php // echo $form->field($model, 'communicationVillage') ?>

    <?php // echo $form->field($model, 'communicationMandal') ?>

    <?php // echo $form->field($model, 'communicationDistrict') ?>

    <?php // echo $form->field($model, 'communicationSource') ?>

    <?php // echo $form->field($model, 'createdDate') ?>

    <?php // echo $form->field($model, 'updatedDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
