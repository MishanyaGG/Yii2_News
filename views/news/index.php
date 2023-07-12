<?php

use app\models\News;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Новости';
?>

<div class="news-index">

    <div style="margin-left: 38%">
        <!-- Форма Для вывода фильтров новостей -->
        <?= $form = Html::beginForm(['news/filter'], 'post') ?>
        <div style="display: flex">
            <select name="id_categories" onchange="onchancheCategory()" id="id_categories" style="margin-right: 10px; width: 30%" class="form-select" aria-label="Пример выбора по умолчанию">
                <option selected disabled >Категории</option>
                <!-- Перебираем -->
                <?php foreach ($category as $row) { ?>
                    <!-- Условие для переноса новостей на след. строку -->
                    <option value="<?= $row['id'] ?>"><?= $row['name_of_category'] ?></option>
                <?php } ?>
            </select>
            <button class="btn btn-primary" type="submit">Поиск</button>
        </div>
        <?= Html::endForm() ?>
    </div>
    <!-- Если зашли под учетной записью   -->
    <?php if (!Yii::$app->user->isGuest) { ?>
        <div style="margin-left: 25%; margin-top: 10px">
            <?= Html::a('Добавить категорию',['categories/create'],['class'=>'btn btn-success']) ?>
            <?= Html::a('Изменить название категории',['categories/update'],['class'=>'btn btn-secondary','id'=>'btnUpdate']) ?>
            <?= Html::a('Удалить категорию',['categories/delete'],['class'=>'btn btn-danger', 'id'=>'btnDelete']) ?>
        </div>
    <?php } ?>

    <select onchange="onchangeSelectFilter()" id="listFilter" style="width: 30%; margin-top: 10px" class="form-select">
        <option selected disabled>Фильтрация новостей</option>
        <option value="new">Актуальные</option>
        <option value="old">Старые</option>
    </select>

</div>


<!-- Новости -->
<?= ListView::widget([
        // Данные
        'dataProvider'=>$dataProvider,
        // Место вывода значений
        'itemView'=>'list/_newsList',
        // Родительский тэг
        'options'=>[
                'tag'=>'div',
                'class'=>'row g-4 py-5'
        ],
        // Тэг для каждого элемента
        'itemOptions'=>[
                'tag'=>'div',
                'class'=>'feature col'
        ],
        'summary'=>''
]) ?>