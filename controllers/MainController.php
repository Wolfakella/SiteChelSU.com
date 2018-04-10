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
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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



        if ($model->load(Yii::$app->request->post())) {

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
        $model = new Plus;
        $model_name= new Students;
        $this->view->title = 'Запись';
        $data = new FirstForm;
        $data->load(Yii::$app->request->post());
        
        $group = Group::findOne($data->group);
        $visits = [];
        $students = $group->students;
		  foreach($students as $v)
		  {
		  		$visit = new Visit();
		  		$visit->students_id = $v->id;
		  		$visit->teacher_id = $data->teacher;
		  		$visit->subject_id = $data->subject;
		  		$visit->date = $data->date;
		  		$visits[] = $visit;
		  }

        return $this->render('get', [
            'name' => $model_name, 'model' => $model, 'v' => $group, 'visits' => $visits
        ]);
    }
   public function actionCreate()
   {
        $model = $_POST['Visit'];
        $visit = [];
        foreach ($model as $value)
        {

            $visit = new Visit;
            $visit->students_id = $value[students_id];
            $visit->teacher_id = $value[teacher_id];
            $visit->subject_id = $value[subject_id];
            $visit->date = $value[date];
            $visit->plus_id = $value[plus_id];
            $visit->save();
        }

        return $this->render('create', [
            'visit' => $visit,
        ]);
    }
}
