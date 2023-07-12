<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\News $model */

$this->title = $model->information;
?>
<div class="news-view">
    <?= \yii\widgets\ListView::widget([
             // Данные
        'dataProvider'=>$dataProvider,
    // Место вывода значений
    'itemView'=>'list/_viewList',
    // Родительский тэг
    'options'=>[
            'tag'=>'div',
            'style'=>'margin-left: 3%'
    ],
        'summary'=>''
    ]) ?>

</div>
