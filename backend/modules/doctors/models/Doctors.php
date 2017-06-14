<?php

namespace app\modules\doctors\models;

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
 * @property resource $doctorImage
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
     
     public $countriesList;
     public $statesData;
     public $citiesData;
     public $state;
     public $country;
	
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
            [[ 'name', 'qualification', 'city', 'state',  'country',  'address', 'pinCode', 'doctorMobile', 'summery', 'APMC', 'TSMC','username','email'], 'required'],
            [['userId', 'state', 'country', 'createdBy', 'updatedBy'], 'integer'],
            [['qualification', 'address','summery'], 'string'],
            [['stateName', 'countryName','createdDate', 'updatedDate','createdBy', 'updatedBy','name', 'qualification', 'city', 'state',  'country',  'address', 'pinCode', 'doctorMobile', 'doctorImage', 'summery', 'APMC', 'TSMC','userId','doctorUniqueId','username','email','password'], 'safe'],
            [[ 'name', 'city', 'stateName', 'countryName', 'APMC', 'TSMC'], 'string', 'max' => 200],
           // [['pinCode', 'doctorMobile'], 'string', 'max' => 20],
        		[
        		'username',
        		'unique',
        		'targetClass' => '\common\models\User',
        		'message' => 'User name already exists try for new',
        		'on' => 'create'
        				],
        				[
        						'password',
        						'match',
        						// char and number and special symbol
        						'pattern' => '/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/',
        						'message' => 'should contain min 6 char with atleast 1 letter and 1 number'
        				],
        				[
        						'email',
        						'match',
        						'pattern' => '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        						'message' => 'Email can contain @ and .com characters.'
        				]
        				,
        		
        				['email','email'],
        				[['confirmpassword'],'compare','compareAttribute' => 'password'],
        				['confirmpassword', 'required', 'on' => 'create'],
        		        ['password', 'required', 'on' => 'create'],
        		
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
    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'doctorid']);
    }
}
