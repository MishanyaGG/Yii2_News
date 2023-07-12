<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\News $model */

$this->title = Yii::t('app', 'Изменение новости', [
    'name' => $model->id,
]);
?>
<div class="news-update">

    <?= \yii\widgets\ListView::widget([
             // Данные
        'dataProvider'=>$dataProvider,
    // Место вывода значений
    'itemView'=>'list/_form',
    // Родительский тэг
    'options'=>[
            'tag'=>'div',
            'style'=>'margin-left: 3%'
    ],
        'summary'=>''
    ]) ?>

</div>
