<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

?>

<?php
    $number;
    echo '<div class="container">
    <h2>Сверка данных</h2>';
?>
<p>
<h3><b>Группа: </b><?php echo $group->group; ?><?
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

<?php
    echo '<table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Студент</th>
            <th>Посещаемость</th>
        </tr>
        </thead>
        <tbody>
        ';
        foreach ($dataOne as $data)
        {
            echo '<tr>';
            echo '<td>'.$data['student'].'</td>';
            echo '<td>'.$data['plus'].'</td>';
            echo '</tr>';
        }

        echo '</tbody>
    </table>';?>


<?php $form = ActiveForm::begin(['id' => 'ThirdForm','action' => ['main/finish']]);?>

<?php echo $form->field($dd, "verifyCode")->widget(Captcha::className()); ?>

<div class="form-group">
    <?= Html::submitButton('Дальше', ['class' => 'btn btn-success']) ?>
</div>
<?php  ActiveForm::end(); ?>

</div>



