<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property integer $id
 * @property string $teacher_sur_name
 * @property string $teacher_name
 * @property string $teacher_patronymic_name
 * @property string $teacher_phone_number
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_sur_name', 'teacher_name', 'teacher_patronymic_name'], 'string', 'max' => 255],
            [['teacher_phone_number'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teacher_sur_name' => 'Teacher Sur Name',
            'teacher_name' => 'Teacher Name',
            'teacher_patronymic_name' => 'Teacher Patronymic Name',
            'teacher_phone_number' => 'Teacher Phone Number',
        ];
    }
}
