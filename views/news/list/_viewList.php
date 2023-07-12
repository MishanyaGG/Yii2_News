<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\News;

$this->title = $model->header;

$modelCategories = new News();

$modelCategories = News::findOne($model->id);

$nameOfCategories = $modelCategories->getCategories()->asArray()->all();
?>

    <h1><?= Html::encode($model->header) ?></h1>
    <p style="color: green;"><?= $nameOfCategories[0]['name_of_category'] ?></p> <p>Дата подачи <?= Html::encode($model->date) ?></p>
    <p><?= Html::encode($model->information) ?></p>
