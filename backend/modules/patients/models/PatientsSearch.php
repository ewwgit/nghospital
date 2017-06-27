<?php

namespace app\modules\patients\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\patients\models\Patients;

/**
 * PatientsSearch represents the model behind the search form about `app\modules\patients\models\Patients`.
 */
class PatientsSearch extends Patients
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patientId', 'country', 'state'], 'integer'],
            [['firstName', 'lastName', 'gender', 'age', 'dateOfBirth', 'patientUniqueId', 'countryName', 'stateName', 'district', 'city', 'mandal', 'village', 'pinCode', 'cardNo', 'mobile', 'caseNo', 'claimNo', 'IPNo', 'IPRegistrationDate', 'category', 'patientProcedure', 'caseStatus', 'cardIssuedDate', 'caste', 'occupation', 'relationshipWithFamilyHead', 'cardHouseNo', 'cardStreet', 'cardHamlet', 'cardVillage', 'cardMandal', 'cardDistrict', 'cardConatctNumber', 'cardSourceNumber', 'communicationHouseNo', 'communicationStreet', 'communicationHamlet', 'communicationVillage', 'communicationMandal', 'communicationDistrict', 'communicationSource', 'createdDate', 'updatedDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Patients::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'patientId' => $this->patientId,
            'dateOfBirth' => $this->dateOfBirth,
            'country' => $this->country,
            'state' => $this->state,
            'IPRegistrationDate' => $this->IPRegistrationDate,
            'cardIssuedDate' => $this->cardIssuedDate,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'patientUniqueId', $this->patientUniqueId])
            ->andFilterWhere(['like', 'countryName', $this->countryName])
            ->andFilterWhere(['like', 'stateName', $this->stateName])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'mandal', $this->mandal])
            ->andFilterWhere(['like', 'village', $this->village])
            ->andFilterWhere(['like', 'pinCode', $this->pinCode])
            ->andFilterWhere(['like', 'cardNo', $this->cardNo])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'caseNo', $this->caseNo])
            ->andFilterWhere(['like', 'claimNo', $this->claimNo])
            ->andFilterWhere(['like', 'IPNo', $this->IPNo])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'patientProcedure', $this->patientProcedure])
            ->andFilterWhere(['like', 'caseStatus', $this->caseStatus])
            ->andFilterWhere(['like', 'caste', $this->caste])
            ->andFilterWhere(['like', 'occupation', $this->occupation])
            ->andFilterWhere(['like', 'relationshipWithFamilyHead', $this->relationshipWithFamilyHead])
            ->andFilterWhere(['like', 'cardHouseNo', $this->cardHouseNo])
            ->andFilterWhere(['like', 'cardStreet', $this->cardStreet])
            ->andFilterWhere(['like', 'cardHamlet', $this->cardHamlet])
            ->andFilterWhere(['like', 'cardVillage', $this->cardVillage])
            ->andFilterWhere(['like', 'cardMandal', $this->cardMandal])
            ->andFilterWhere(['like', 'cardDistrict', $this->cardDistrict])
            ->andFilterWhere(['like', 'cardConatctNumber', $this->cardConatctNumber])
            ->andFilterWhere(['like', 'cardSourceNumber', $this->cardSourceNumber])
            ->andFilterWhere(['like', 'communicationHouseNo', $this->communicationHouseNo])
            ->andFilterWhere(['like', 'communicationStreet', $this->communicationStreet])
            ->andFilterWhere(['like', 'communicationHamlet', $this->communicationHamlet])
            ->andFilterWhere(['like', 'communicationVillage', $this->communicationVillage])
            ->andFilterWhere(['like', 'communicationMandal', $this->communicationMandal])
            ->andFilterWhere(['like', 'communicationDistrict', $this->communicationDistrict])
            ->andFilterWhere(['like', 'communicationSource', $this->communicationSource]);

        return $dataProvider;
    }
}
