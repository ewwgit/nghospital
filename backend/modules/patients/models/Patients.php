<?php

namespace app\modules\patients\models;

use Yii;

/**
 * This is the model class for table "patients".
 *
 * @property integer $patientId
 * @property string $firstName
 * @property string $lastName
 * @property string $gender
 * @property string $age
 * @property string $dateOfBirth
 * @property string $patientUniqueId
 * @property integer $country
 * @property string $countryName
 * @property integer $state
 * @property string $stateName
 * @property string $district
 * @property string $city
 * @property string $mandal
 * @property string $village
 * @property string $pinCode
 * @property string $cardNo
 * @property string $mobile
 * @property string $caseNo
 * @property string $claimNo
 * @property string $IPNo
 * @property string $IPRegistrationDate
 * @property string $category
 * @property string $patientProcedure
 * @property string $caseStatus
 * @property string $cardIssuedDate
 * @property string $caste
 * @property string $occupation
 * @property string $relationshipWithFamilyHead
 * @property string $cardHouseNo
 * @property string $cardStreet
 * @property string $cardHamlet
 * @property string $cardVillage
 * @property string $cardMandal
 * @property string $cardDistrict
 * @property string $cardConatctNumber
 * @property string $cardSourceNumber
 * @property string $communicationHouseNo
 * @property string $communicationStreet
 * @property string $communicationHamlet
 * @property string $communicationVillage
 * @property string $communicationMandal
 * @property string $communicationDistrict
 * @property string $communicationSource
 * @property string $createdDate
 * @property string $updatedDate
 */
class Patients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	
	public $countriesList;
	public $statesData;
	public $citiesData;
	
    public static function tableName()
    {
        return 'patients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'gender', 'age', 'dateOfBirth', 'patientUniqueId', 'country', 'countryName', 'state', 'stateName', 'district', 'city', 'mandal', 'village', 'pinCode', 'cardNo', 'mobile', 'caseNo', 'claimNo', 'IPNo', 'IPRegistrationDate', 'category', 'patientProcedure', 'caseStatus', 'cardIssuedDate', 'caste', 'occupation', 'relationshipWithFamilyHead', 'cardHouseNo', 'cardStreet', 'cardHamlet', 'cardVillage', 'cardMandal', 'cardDistrict', 'cardConatctNumber', 'cardSourceNumber', 'communicationHouseNo', 'communicationStreet', 'communicationHamlet', 'communicationVillage', 'communicationMandal', 'communicationDistrict', 'communicationSource', 'createdDate', 'updatedDate'], 'required'],
            [['gender', 'patientProcedure', 'caseStatus'], 'string'],
            [['dateOfBirth', 'IPRegistrationDate', 'cardIssuedDate', 'createdDate', 'updatedDate'], 'safe'],
            [['country', 'state'], 'integer'],
            [['firstName', 'lastName', 'patientUniqueId', 'countryName', 'stateName', 'district', 'city', 'mandal', 'village', 'cardNo', 'caseNo', 'claimNo', 'category', 'caste', 'occupation', 'relationshipWithFamilyHead', 'cardHouseNo', 'cardStreet', 'cardHamlet', 'cardVillage', 'cardMandal', 'cardDistrict', 'cardSourceNumber', 'communicationHouseNo', 'communicationStreet', 'communicationHamlet', 'communicationVillage', 'communicationMandal', 'communicationDistrict', 'communicationSource'], 'string', 'max' => 200],
            [['age'], 'string', 'max' => 10],
            [['pinCode', 'mobile', 'cardConatctNumber'], 'string', 'max' => 15],
            [['IPNo'], 'string', 'max' => 20],
        	[['age','mobile','pinCode'],'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'patientId' => 'Patient ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'gender' => 'Gender',
            'age' => 'Age',
            'dateOfBirth' => 'Date Of Birth',
            'patientUniqueId' => 'Patient Unique ID',
            'country' => 'Country',
            'countryName' => 'Country Name',
            'state' => 'State',
            'stateName' => 'State Name',
            'district' => 'District',
            'city' => 'City',
            'mandal' => 'Mandal',
            'village' => 'Village',
            'pinCode' => 'Pin Code',
            'cardNo' => 'Card No',
            'mobile' => 'Mobile',
            'caseNo' => 'Case No',
            'claimNo' => 'Claim No',
            'IPNo' => 'Ipno',
            'IPRegistrationDate' => 'Ipregistration Date',
            'category' => 'Category',
            'patientProcedure' => 'Patient Procedure',
            'caseStatus' => 'Case Status',
            'cardIssuedDate' => 'Card Issued Date',
            'caste' => 'Caste',
            'occupation' => 'Occupation',
            'relationshipWithFamilyHead' => 'Relationship With Family Head',
            'cardHouseNo' => 'Card House No',
            'cardStreet' => 'Card Street',
            'cardHamlet' => 'Card Hamlet',
            'cardVillage' => 'Card Village',
            'cardMandal' => 'Card Mandal',
            'cardDistrict' => 'Card District',
            'cardConatctNumber' => 'Card Conatct Number',
            'cardSourceNumber' => 'Card Source Number',
            'communicationHouseNo' => 'Communication House No',
            'communicationStreet' => 'Communication Street',
            'communicationHamlet' => 'Communication Hamlet',
            'communicationVillage' => 'Communication Village',
            'communicationMandal' => 'Communication Mandal',
            'communicationDistrict' => 'Communication District',
            'communicationSource' => 'Communication Source',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
