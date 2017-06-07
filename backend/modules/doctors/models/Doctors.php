<?php

namespace backend\modules\doctors\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "doctors".
 *
 * @property integer $doctorid
 * @property integer $userId
 * @property string $doctorUniqueId
 * @property string $name
 * @property string $qualification
 * @property string $city
 * @property integer $state
 * @property string $stateName
 * @property integer $country
 * @property string $countryName
 * @property string $address
 * @property string $pinCode
 * @property string $doctorMobile
 * @property string $doctorImage
 * @property string $summery
 * @property string $APMC
 * @property string $TSMC
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Doctors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	
	public $username;
	public $email;
	public $password;
	public $confirmpassword;
	
    public static function tableName()
    {
        return 'doctors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'doctorUniqueId', 'name', 'qualification', 'city', 'stateName', 'countryName', 'address', 'pinCode', 'doctorMobile', 'doctorImage', 'summery', 'APMC', 'TSMC', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate'], 'required'],
            [['userId', 'state', 'country', 'createdBy', 'updatedBy'], 'integer'],
            [['qualification', 'address', 'doctorImage', 'summery'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['doctorUniqueId', 'name', 'city', 'stateName', 'countryName', 'APMC', 'TSMC'], 'string', 'max' => 200],
            [['pinCode', 'doctorMobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doctorid' => 'Doctorid',
            'userId' => 'User ID',
            'doctorUniqueId' => 'Doctor Unique ID',
            'name' => 'Name',
            'qualification' => 'Qualification',
            'city' => 'City',
            'state' => 'State',
            'stateName' => 'State Name',
            'country' => 'Country',
            'countryName' => 'Country Name',
            'address' => 'Address',
            'pinCode' => 'Pin Code',
            'doctorMobile' => 'Doctor Mobile',
            'doctorImage' => 'Doctor Image',
            'summery' => 'Summery',
            'APMC' => 'Apmc',
            'TSMC' => 'Tsmc',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
