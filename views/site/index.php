<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Главная страница';

?>

<!-- Заголовок -->
<title><?= Html::encode($this->title) ?></title>

<!-- Если не вошли в аккаунт -->
<?php if (!isset($pols)) { ?>
    <ul class="nav nav-pills">
        <!-- Вход в акк -->
        <li class="nav-item"><a href="<?= \yii\helpers\Url::to('../site/login') ?>" class="nav-link active" aria-current="page">Для администратора</a></li>
    </ul>
    </header>
    </div>

    <div style="margin-left: 35%">
        <!-- Форма Для вывода фильтров новостей -->
        <?= $form = Html::beginForm(['site/form'], 'post') ?>
        <div style="display: flex">
            <select name="categori_name" style="margin-right: 10px; width: 30%" class="form-select" aria-label="Пример выбора по умолчанию">
                <option selected disabled>Категории</option>
                <?php foreach ($select as $row) { ?>
                    <?php for ($i = 0; $i < count($row); $i++) { ?>
                        <option value="<?= $row[$i]['id'] ?>"><?= $row[$i]['nasvanie'] ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <button class="btn btn-primary" type="submit">Поиск</button>
        </div>
        <?= Html::endForm() ?>
    </div>

    <div class="row g-4 py-5 ">
        <!-- Вывод всех новостей -->
        <?php foreach ($news_row as $news) { ?>
            <?php for ($i = 0; $i < count($news); $i++) { ?>
                <!-- Сделано, чтобы карточки новостей не выводились в одну строку (были ошибки при выводе относительно фронта) -->
                <?php if ($i / 3 == 1) { ?>
    </div>
    <div class="row g-4 py-5">
        <div class="feature col">
            <h3 class="fs-2"><?= $news[$i]['sagolovok'] ?></h3>
            <p style="color: green;"><?= $news[$i]['nasvanie'] ?></p> <p>Дата подачи <?= $news[$i]['date'] ?></p>
            <p><?= $news[$i]['info_news'] ?></p>

            <!-- Переход на страницу Подробная информация -->
            <?= $form = Html::beginForm(['site/info', 'post']) ?>
            <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
            <button class="btn btn-primary" type="submit">Подробнее</button>
            <?= Html::endForm() ?>

        </div>
    <?php } else { ?>
        <div class="feature col">
            <h3 class="fs-2"><?= $news[$i]['sagolovok'] ?></h3>
            <p style="color: green;"><?= $news[$i]['nasvanie'] ?></p> <p>Дата подачи <?= $news[$i]['date'] ?></p>
            <p><?= $news[$i]['info_news'] ?></p>

            <!-- Переход на страницу Подробная информация -->
            <?= $form = Html::beginForm(['site/info', 'post']) ?>
            <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
            <button class="btn btn-primary" type="submit">Подробнее</button>
            <?= Html::endForm() ?>

        </div>
    <?php } ?>
<?php } ?>
<?php } ?>
    </div>
<?php } else { ?>
    <ul class="nav nav-pills">
        <a href="<?= Url::to(['create_news']) ?>"><button type="button" style="margin-right: 20px" class="btn btn-success">Добавить новость</button></a>
        <?php foreach ($pols as $arr) { ?>
            <li class="nav-item" style="margin-right: 10px"> <?= $arr[0]['login'] ?></li>
        <?php } ?>
        <li class="nav-item"><a href="<?= Url::to(['out']) ?>" class="nav-link active" aria-current="page">Выход</a></li>
    </ul>
    </header>
    </div>

    <div style="margin-left: 35%">
        <?= $form = Html::beginForm(['site/form'], 'post') ?>
        <div style="display: flex">
            <select name="categori_name" style="margin-right: 10px; width: 30%" class="form-select" aria-label="Пример выбора по умолчанию">
                <option selected disabled>Категории</option>
                <?php foreach ($select as $row) { ?>
                    <?php for ($i = 0; $i < count($row); $i++) { ?>
                        <option value="<?= $row[$i]['id'] ?>"><?= $row[$i]['nasvanie'] ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <button class="btn btn-primary" type="submit">Поиск</button>
        </div>
        <?= Html::endForm() ?>
    </div>

    <div class="row g-4 py-5 ">
        <?php foreach ($news_row as $news) { ?>
            <?php for ($i = 0; $i < count($news); $i++) { ?>
                <?php if ($i / 3 == 1 || $i % 3 == 0) { ?>
                    </div>
                    <div class="row g-4 py-5">
                        <div class="feature col">
                            <h3 class="fs-2"><?= $news[$i]['sagolovok'] ?></h3>
                            <p style="color: green;"><?= $news[$i]['nasvanie'] ?></p> <p>Дата подачи <?= $news[$i]['date'] ?></p>
                            <p><?= $news[$i]['info_news'] ?></p>

                            <div style="margin: 5px">
                                <!-- Переход на страницу Подробная информация -->
                                <?= $form = Html::beginForm(['site/info', 'post']) ?>
                                    <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
                                    <button class="btn btn-primary" type="submit">Подробнее</button>
                                <?= Html::endForm() ?>
                            </div>

                            <div style="margin: 5px">
                                <!-- Переход на страницу редактирования страницы -->
                                <?= $form = Html::beginForm(['site/read_news', 'post']) ?>
                                    <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
                                    <button class="btn btn-secondary" type="submit">Изменить новость</button>
                                <?= Html::endForm() ?>
                            </div>

                            <div style="margin: 5px">
                                <!-- Удаление новости -->
                                <?= $form = Html::beginForm(['site/read_news', 'post']) ?>
                                    <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
                                    <button class="btn btn-danger" type="submit">Удалить новость</button>
                                <?= Html::endForm() ?>
                            </div>

                        </div>
                <?php } else { ?>
                    <div class="feature col">
                        <h3 class="fs-2"><?= $news[$i]['sagolovok'] ?></h3>
                        <p style="color: green;"><?= $news[$i]['nasvanie'] ?></p> <p>Дата подачи <?= $news[$i]['date'] ?></p>
                        <p><?= $news[$i]['info_news'] ?></p>

                        <div style="margin: 5px">
                            <!-- Переход на страницу Подробная информация -->
                            <?= $form = Html::beginForm(['site/info', 'post']) ?>
                                <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
                                <button class="btn btn-primary" type="submit">Подробнее</button>
                            <?= Html::endForm() ?>
                        </div>

                        <div style="margin: 5px">
                            <!-- Переход на страницу редактирования страницы -->
                            <?= $form = Html::beginForm(['site/read_news', 'post']) ?>
                                <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
                                <button class="btn btn-secondary" type="submit">Изменить новость</button>
                            <?= Html::endForm() ?>
                        </div>

                        <div style="margin: 5px">
                            <!-- Удаление новости -->
                            <?= $form = Html::beginForm(['site/del_news', 'post']) ?>
                                <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
                                <button class="btn btn-danger" type="submit">Удалить новость</button>
                            <?= Html::endForm() ?>
                        </div>

                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>