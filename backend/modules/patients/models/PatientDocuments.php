<?php

namespace app\modules\patients\models;

use Yii;

/**
 * This is the model class for table "patient_documents".
 *
 * @property integer $pdocumentId
 * @property integer $patientInfoId
 * @property string $documentUrl
 */
class PatientDocuments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pdocumentId', 'patientInfoId', 'documentUrl'], 'required'],
            [['pdocumentId', 'patientInfoId'], 'integer'],
            [['documentUrl'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pdocumentId' => 'Pdocument ID',
            'patientInfoId' => 'Patient Info ID',
            'documentUrl' => 'Document Url',
        ];
    }
}
