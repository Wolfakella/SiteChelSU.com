<?php

use app\models\Students;
use app\models\Teacher;
use app\models\Subject;
use app\models\Visit;
use app\models\Plus;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\journal\VisitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Visit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'students_id',
                'filter' => Students::find()->select(["CONCAT(name, ' ',sur_name, ' ',patronymic_name)", 'id'])->indexBy('id')->column(),
                    'value' => 'students.name',
                'label' => 'Студенты',
            ],
            [
                'attribute' => 'teacher_id',
                'filter' => Teacher::find()->select(["CONCAT(teacher_name, ' ',teacher_sur_name)", 'id'])->indexBy('id')->column(),
                'value' => 'teacher.teacher_sur_name',
                'label' => 'Преподаватель',
            ],
            [
                'attribute' => 'subject_id',
                'filter' => Subject::find()->select(['subject', 'id'])->indexBy('id')->column(),
                'value' => 'subject.subject',
                'label' => 'Пара',
            ],
            [
                'attribute' => 'plus_id',
                'filter' => Plus::find()->select(['operation', 'id'])->indexBy('id')->column(),
                'value' => 'plus.operation',
                'label' => 'Посещаемость',
            ],
            [
                'attribute' => 'date',
                'format' => 'date',
                'label' => 'Дата',
                'filter' => DatePicker::widget( [
                'name' => 'date',
                    'model' => $searchModel,
                    'attribute' => 'date',
                    'language' => 'ru',
                    'removeButton' => [
                        'icon'=>'trash',
                    ],
                    'pickerButton' => [
                        'icon'=>'ok',
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
            ]
                ]),


            ],



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

//    echo '<label class="control-label">Check Date</label>';
//    echo DatePicker::widget([
//        'attribute' => 'date',
//        'name' => 'check_date',
//        'removeButton' => false,
//        'pluginOptions' => [
//            'autoclose'=>true,
//            'format' => 'mm/dd/yyyy'
//        ]
//    ]);



    ?>
</div>
