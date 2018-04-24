<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property string $name
 * @property string $sur_name
 * @property string $patronymic_name
 * @property integer $group_id
 *
 * @property Group $group
 */
class students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'integer'],
            [['name', 'sur_name', 'patronymic_name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sur_name' => 'Sur Name',
            'patronymic_name' => 'Patronymic Name',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getFio()
    {
        return $this->sur_name.' '.$this->name;
    }


    public function getTotal()
    {
    	  $count = Visit::find()->where(['students_id' => $this->id])->count();
    	  $success = Visit::find()->where(['students_id' => $this->id, 'plus_id' => 1])->count();
    	  if($count == 0) return 'Нет информации по студенту.';
			else return round($success / $count, 2) * 100 . '%';
    }


	public function getSubjects()
	{
		return Visit::find()
			->select('subject_id')
			->where(['students_id' => $this->id])
			->groupBy(['subject_id'])
			->asArray()
			->all();
	}

    public function totalSubject($subject_id = null)
    {
    	if($subject_id == null) return 'Нет информации';
			$count = Visit::find()->where(['students_id' => $this->id, 'subject_id' => $subject_id])->count();
			$success = Visit::find()->where(['students_id' => $this->id, 'subject_id' => $subject_id, 'plus_id' => 1])->count();
			if($count == 0) return 'Нет информации.';
			else return round($success / $count, 2) * 100 . '%';
    }
}
