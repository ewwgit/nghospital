<?php

namespace app\modules\specialities\models;

use Yii;

/**
 * This is the model class for table "specialities".
 *
 * @property integer $spId
 * @property string $specialityName
 * @property string $specialityCode
 * @property string $description
 * @property string $status
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Specialities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specialities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specialityName', 'specialityCode', 'description', 'status'], 'required'],
            [['description', 'status'], 'string'],
            [['createdBy', 'updatedBy'], 'integer'],
            [['createdDate', 'updatedDate', 'createdBy', 'updatedBy'], 'safe'],
            [['specialityName'], 'string', 'max' => 200],
            //[['specialityCode'], 'string', 'max' => 10],
        		['specialityName',
        		'unique',
        		'message' => 'This specialityName has already been taken.'],
        		['specialityCode',
        		'unique',
        		'message' => 'This specialityCode has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'spId' => 'Speciality ID',
            'specialityName' => 'Speciality Name',
            'specialityCode' => 'Speciality Code',
            'description' => 'Description',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
    public static function getSpname($uId) {
    	$specialitiesdata = Specialities::find()->select(['specialityName'])->where(['spId'=>$uId])->one();
    	return $specialitiesdata['specialityName'];
    }
}
