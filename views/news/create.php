<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\News $model */

$this->title = 'Создание новости';
?>
<div class="news-create">

    <?= $this->render('list/_form', [
        'model' => $model,
        'categories'=>$categories
    ]) ?>

</div>
