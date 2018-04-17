<?php
/**
 * Created by PhpStorm.
 * User: Artur Khamidulin
 * Date: 02.04.2018
 * Time: 23:19
 */

namespace app\models\form;

use yii\db\ActiveRecord;

class FirstForm extends ActiveRecord
{
    public $teacher;
    public $group;
    public $subject;
    public $date;
    public $verifyCode;

    public function attributeLabels()
    {
        return [
            'teacher' => 'Преподаватель',
            'group' => 'Группа',
            'subject' => 'Предмет',
            'date' => 'Дату',
            'verifyCode' => 'Verification Code',
        ];
    }

    public function rules()
    {
        return [
                [['teacher','group','subject','date'],'required'],

                ['verifyCode', 'captcha'],
        ];
    }

}