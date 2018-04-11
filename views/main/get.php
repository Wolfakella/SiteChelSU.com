<?php
use app\models\Students;
use app\models\Teacher;
use app\models\Subject;
use app\models\Plus;
use app\models\Group;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>
<div class="get-index">

    <p>
    <h3><b>Группа: <?php echo $group->group; ?></b><?
        ?></h3>
    </p>
    <p><b>Преподаватель: </b><?php
        echo $teacher->teacher_sur_name.' '.$teacher->teacher_name.' '.$teacher->teacher_patronymic_name.' ';
        ?></p>
    <b>Предмет: </b> <?php
    echo $subject->subject;
    $date_view = date_create($date);
    echo '<h4>'.date_format($date_view, 'j F Y').'</h4>';
    ?>


    <div class="visit-form">
    <h3>Студенты: </h3>


        <?php $form = ActiveForm::begin(['id' => 'SecondForm','action' => ['main/create']/*'/index.php?r=main%2Fcreate'*/]);?>

        <?php

        foreach ($visits as $index => $v)
        {
            echo $form->field($v, "[$index]plus_id")->dropDownList(Plus::find()->select(['operation', 'id'])->indexBy('id')->column(), ['prompt' => ''])->label($v->students->name.' '.$v->students->sur_name);
            echo $form->field($v, "[$index]students_id", [
                'template' => "{input}",
                'options' => ['tag' => false]
            ])->hiddenInput();
            echo $form->field($v, "[$index]subject_id", [
                'template' => "{input}",
                'options' => ['tag' => false]
            ])->label('')->hiddenInput();
            echo $form->field($v, "[$index]teacher_id", [
                'template' => "{input}",
                'options' => ['tag' => false]
            ])->label('')->hiddenInput();
            echo $form->field($v, "[$index]date", [
                'template' => "{input}",
                'options' => ['tag' => false]
            ])->label('')->hiddenInput();
        }


        ?>


        <div class="form-group">
        <?= Html::submitButton('Дальше', ['class' => 'btn btn-success']) ?>
    </div>
 <?php  ActiveForm::end(); ?>
    </div>
</div>
