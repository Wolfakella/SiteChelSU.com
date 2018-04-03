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
<?php

$array = $_POST['FirstForm'];

$teacher = $array['teacher'];

$group = $array['group'];

$subject = $array['subject'];

$date = $array['date'];
?>
<div class="get-index">

    <p>
    <h3><b>Группа: </b><?  $group_table = Group::find()->where(['id' => $group])->all();
        foreach ($group_table as $v) {echo $v->group;}?></h3>
    </p>
    <p><b>Преподаватель: </b><?   $teacher_table = Teacher::find()->where(['id' => $teacher])->all();
                foreach ($teacher_table as $v)
                {
                    echo $v->teacher_sur_name.' '.$v->teacher_name.' '.$v->teacher_patronymic_name.' ';
                }?></p>
          <b>Предмет: </b> <?  $subject_table = Subject::find()->where(['id' => $subject])->all();
                foreach ($subject_table as $v)
                {
                    echo $v->subject;
                }
                $date_view = date_create($date);

                echo '<h4>'.date_format($date_view, 'j F Y').'</h4>';
            ?>
    <div class="visit-form">
        <h3>Студенты: </h3>
    <?php $form = ActiveForm::begin(); ?>
        <table>
            <?

            $operation = $form->field($model, 'operation')->label('')->dropDownList(Plus::find()->select(['operation', 'id'])->indexBy('id')->column(), ['prompt' => '']);

                $students = Students::find()->where(['group_id' => $group])->all();
            foreach ($students as $v)
            {
                echo $form->field($model, 'operation')->label('')->dropDownList(Plus::find()->select(['operation', 'id'])->indexBy('id')->column(), ['prompt' => ''])->label($v->name.' '.$v->sur_name);
            }
//                foreach ($students as $v)
//                {
//                    echo "<tr>";
//                    echo "<td><input type='text' name='students' readonly value='$v->name $v->sur_name'></td>";
//                    echo "<td>".$operation."</td>";
//                    echo "</tr>";
//                }

            ?>
            </table><br>
        <div class="form-group">
            <?= Html::submitButton('Дальше', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>