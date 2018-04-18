<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

  $urlOne = Url::toRoute(['site/gtable']);
  $urlTwo = Url::toRoute(['site/ptable']);
  $urlThree = Url::toRoute(['site/prtable']);

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 text-center" style="margin-top:10px;">
              <a href="<?= $urlOne?>" style="width:170px" class="btn btn-info" role="button">Группы</a>
            </div>
            <div class="col-lg-4 text-center" style="margin-top:10px;">
              <a href="<?= $urlTwo?>" style="width:170px" class="btn btn-info" role="button">Предметы</a>
            </div>
            <div class="col-lg-4 text-center" style="margin-top:10px; align:center;">
              <a href="<?= $urlThree?>" style="width:170px" class="btn btn-info" role="button">Преподаватели</a>
            </div>
        </div>

    </div>
</div>
