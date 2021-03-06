<?php
/**
 * Created by PhpStorm.
 * User: Artur Khamidulin
 * Date: 02.04.2018
 * Time: 22:51
 */

namespace app\controllers;

use app\models\Students;
use yii\web\Controller;
use app\models\form\FirstForm;
use app\models\Group;
use app\models\Plus;
use app\models\Visit;
use app\models\Teacher;
use app\models\Subject;
use lowbase\sms\models\Sms;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use Yii;


class MainController extends Controller
{

    public function actionIndex()
    {

        if(Yii::$app->request->isAjax)
        {
            var_dump(Yii::$app->request->post());
            return 'index';
        }
        $model = new FirstForm;



        if ($model->load(Yii::$app->request->post()))
        {

            if ($model->validate()){
                Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка');
            }

        }


        $this->view->title = 'Форма';
        return $this->render('index', [

            'model' => $model,

        ]);

    }

    public function actionGet()
    {

        $items = $_POST['FirstForm'];
        $teacher = $items['teacher'];
        $group = $items['group'];
        $subject = $items['subject'];
        $date = $items['date'];
        $visits = [];
        $group_table = Group::findOne($group);
        $teacher_table = Teacher::findOne($teacher);
        $subject_table = Subject::findOne($subject);
        $student_table = $group_table->students;


        foreach ($student_table as $value)
        {
            $visit = new Visit();
            $visit->students_id = $value->id;
            $visit->teacher_id = $teacher;
            $visit->subject_id = $subject;
            $visit->date = $date;
            $visits[] = $visit;
        }


        return $this->render('get', [
            'items' => $items, 'group' => $group_table, 'subject' => $subject_table, 'teacher' => $teacher_table, 'date' => $date,
            'student' => $student_table, 'visit' => $visit, 'visits' => $visits,
        ]);
    }
   public function actionCreate()
   {
        $dd = new FirstForm;
        $model = $_POST['Visit'];
        $subject = ArrayHelper::getValue($model, '0.subject_id');
        $teacher= ArrayHelper::getValue($model, '0.teacher_id');
        $student = ArrayHelper::getValue($model, '0.students_id');
        $date = ArrayHelper::getValue($model, '0.date');
        $student_table = Students::findOne($student);
        $teacher_table = Teacher::findOne($teacher);
        $subject_table = Subject::findOne($subject);
        $group_table = $student_table->group;
        $sms_teacher = $teacher_table->teacher_phone_number;


        $visits = [];
        $dataOne = [];

       $number = Yii::$app->sms->sendSms($sms_teacher, '1111', true, 1, 5);


        foreach ($model as $value)
        {
            $student = Students::findOne($value['students_id'])->fio;
            $plus = Plus::findOne($value['plus_id'])->operation;
            $dataOne[] = ['student'=> $student , 'plus'=> $plus];
        }

       $session = Yii::$app->session;

       $session->set('session', $model);

        return $this->render('create', [
            'model' => $model, 'group' => $group_table, 'subject' => $subject_table, 'teacher' => $teacher_table, 'date' => $date,
            'dataOne' => $dataOne, 'visit' => $visits, 'dd' => $dd, 'number' => $number,
        ]);
    }

    public function actionFinish()
    {
        //$number = Yii::$app->sms->sendSms('+79090911071', 'Тестовое сообщение', true, 1, 5);

        $data = Yii::$app->session->get('session');


        foreach ($data as $value)
        {

            $visit = new Visit;
            $visit->students_id = $value['students_id'];
            $visit->teacher_id = $value['teacher_id'];
            $visit->subject_id = $value['subject_id'];
            $visit->date = $value['date'];
            $visit->plus_id = $value['plus_id'];
            $visit->save();
        }




        return $this->render('finish', [

            'visit' => $visit,

        ]);
    }



}
