<?php
namespace app\modules\nursinghomes\models;


use Yii;
use common\models\User;

/**
 * This is the model class for table "nursinghomes".
 *
 * @property integer $nursingId
 * @property integer $nuserId
 * @property string $nurshingUniqueId
 * @property string $contactPerson
 * @property string $mobile
 * @property string $city
 * @property integer $state
 * @property string $stateName
 * @property integer $country
 * @property string $countryName
 * @property string $pinCode
 * @property string $address
 * @property string $description
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Nursinghomes extends \yii\db\ActiveRecord
{
	 public $username;
     public $email;
     public $password;
     public $confirmpassword;
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nursinghomes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	['password', 'required', 'on' => 'create'],
            [['nuserId', 'nurshingUniqueId', 'contactPerson', 'mobile', 'city', 'state',  'country', 'pinCode', 'address', 'description',
            		'username','email'], 'required'],
            [['nuserId', 'state', 'country', 'createdBy', 'updatedBy'], 'integer'],
            [['address', 'description'], 'string'],
            [['updatedDate','createdDate','nuserId', 'nurshingUniqueId', 'contactPerson', 'mobile', 'city', 'state', 'stateName', 'country', 'countryName', 'pinCode', 'address', 'description',
            		'username','email','password'], 'safe'],
           // [['nurshingUniqueId', 'mobile'], 'string', 'max' => 20],
            [['contactPerson', 'city', 'stateName', 'countryName'], 'string', 'max' => 200],
          //  [['pinCode'], 'string', 'max' => 10],
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
        		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nursingId' => 'Nursing ID',
            'nuserId' => 'Nuser ID',
            'nurshingUniqueId' => 'Nurshing Unique ID',
            'contactPerson' => 'Contact Person',
            'mobile' => 'Mobile',
            'city' => 'City',
            'state' => 'State',
            'stateName' => 'State Name',
            'country' => 'Country',
            'countryName' => 'Country Name',
            'pinCode' => 'Pin Code',
            'address' => 'Address',
            'description' => 'Description',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'nursingId']);
    }
}
