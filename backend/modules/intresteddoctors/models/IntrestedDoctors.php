<?php

namespace app\modules\intresteddoctors\models;

use Yii;

/**
 * This is the model class for table "intrested_doctors".
 *
 * @property integer $insdocid
 * @property string $name
 * @property string $email
 * @property integer $role
 * @property string $description
 * @property string $mobile
 * @property string $createdDate
 */
class IntrestedDoctors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'intrested_doctors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'role', 'description', 'mobile', 'createdDate'], 'required'],
            [['role'], 'integer'],
            [['description'], 'string'],
            [['createdDate'], 'safe'],
            [['name', 'email'], 'string', 'max' => 200],
            [['mobile'], 'string', 'max' => 20],
        		[
        		'email',
        		'match',
        		'pattern' => '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        		'message' => 'Email can contain @ and .com characters.'
        				],
        		['mobile','integer'],
        		['mobile',
        				'match',
        				'pattern' => '/^[0-9]{10}$/',
        				'message' => 'mobile number must contain exactly 10 numbers.',
        		],
        				
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insdocid' => 'Insdocid',
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
            'description' => 'Description',
            'mobile' => 'Mobile',
            'createdDate' => 'Created Date',
        ];
    }
}
