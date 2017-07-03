<?php

namespace app\modules\doctors\models;

use Yii;

/**
 * This is the model class for table "doctor_slots".
 *
 * @property integer $docslotId
 * @property integer $dsDoctorId
 * @property string $day
 * @property string $startTime
 * @property string $endTime
 */
class DoctorSlots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_slots';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dsDoctorId', 'day', 'startTime', 'endTime'], 'required'],
            [['dsDoctorId'], 'integer'],
            [['day', 'startTime', 'endTime'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'docslotId' => 'Docslot ID',
            'dsDoctorId' => 'Ds Doctor ID',
            'day' => 'Day',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
        ];
    }
}
