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
use app\models\Plus;
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

        return $this->render('get', [
            'name' => $model_name, 'model' => $model,
        ]);
    }
//    public function actionCreate()
//    {
//        $model = new FirstForm();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['create']);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

}