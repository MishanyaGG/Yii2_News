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
                <!-- Перебираем -->
                <?php foreach ($select as $row) { ?>
                    <!-- Условие для переноса новостей на след. строку -->
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

            <?php if (count($news) == 0) { ?>
                <h3>Новости отсутствуют</h3>
            <?php } ?>

            <?php for ($i = 0; $i < count($news); $i++) { ?>
                    <div class="feature col">
                        <h3 class="fs-2"><?= $news[$i]['sagolovok'] ?></h3>
                        <?php foreach ($select as $row) { ?>
                            <!-- Условие для переноса новостей на след. строку -->
                            <?php for ($g = 0; $g < count($row); $g++) { ?>
                                <?php if ($news[$i]['id_kategori']==$row[$g]['id']) {  ?>
                                    <p style="color: green;"><?= $row[$g]['nasvanie'] ?></p> <p>Дата подачи <?= $news[$i]['date'] ?></p>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        <p><?= $news[$i]['info_news'] ?></p>

                        <!-- Переход на страницу Подробная информация -->
                        <?= $form = Html::beginForm(['site/info', 'post']) ?>
                            <input type="hidden" name="id_news" value="<?= $news[$i]['id'] ?>">
                            <button class="btn btn-primary" type="submit">Подробнее</button>
                        <?= Html::endForm() ?>
                    </div>
        <?php } ?>
    <?php } ?>
    </div>

    <?= \yii\widgets\LinkPager::widget([
            'pagination'=>$pages,
    ]); ?>
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
        <!-- Обработка фильтрации -->
        <?= $form = Html::beginForm(['site/form'], 'post') ?>
        <div style="display: flex" id="kategori">
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

        <div style="display: flex">
            <div style="margin-top: 10px">
                <button type="button" class="btn btn-success" id="create_btn_kat">Добавить категорию</button>
                <div class="create_kat" style="display: flex" id="create_kat">

                    <?= $form = Html::beginForm(['site/create_kat','post']) ?>
                        <input type="text" name="kategori" class="form-control" placeholder="Название категории"> <button style="margin-top: 10px" class="btn btn-success">Добавить</button>
                        <button id="btn_close" style="margin-top: 10px" type="button" class="btn btn-secondary">Закрыть</button>
                    <?= Html::endForm() ?>

                </div>
            </div>
            <div style="margin-top: 10px">
                <button type="button" style="margin-left: 10px" class="btn btn-danger" id="del_btn_kat">Удалить категорию</button>
                <div class="create_kat" style="display: flex" id="del_kat">

                    <?= $form = Html::beginForm(['site/del_kat','post']) ?>
                        <select name="categori_name" class="form-select" aria-label="Пример выбора по умолчанию">
                        <option selected disabled>Категории</option>

                            <?php foreach ($select as $row) { ?>
                                <?php for ($i = 0; $i < count($row); $i++) { ?>
                                    <option value="<?= $row[$i]['id'] ?>"><?= $row[$i]['nasvanie'] ?></option>
                                <?php } ?>
                            <?php } ?>

                        </select>
                        <button style="margin-top: 10px" class="btn btn-danger">Удалить</button>
                        <button id="btn_close_del" style="margin-top: 10px" type="button" class="btn btn-secondary">Закрыть</button>
                    <?= Html::endForm() ?>

                </div>
            </div>


            <div style="margin-top: 10px">
                <button type="button" style="margin-left: 10px" class="btn btn-primary" id="edit_btn_kat">Изменить категорию</button>
                <div class="create_kat" style="display: flex" id="edit_kat">

                    <?= $form = Html::beginForm(['site/edit_kat','post']) ?>
                        <select name="categori_name" class="form-select" aria-label="Пример выбора по умолчанию">
                        <option selected disabled>Выберите категорию, которую хотите заменить</option>

                            <?php foreach ($select as $row) { ?>
                                <?php for ($i = 0; $i < count($row); $i++) { ?>
                                    <option value="<?= $row[$i]['id'] ?>"><?= $row[$i]['nasvanie'] ?></option>
                                <?php } ?>
                            <?php } ?>

                        </select>

                        <input type="text" placeholder="Новое название" name="edit_kat">
                        <button style="margin-top: 10px" class="btn btn-primary">Изменить</button>
                        <button id="btn_close_edit" style="margin-top: 10px" type="button" class="btn btn-secondary">Закрыть</button>
                    <?= Html::endForm() ?>

                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 py-5 ">
        <?php foreach ($news_row as $news) { ?>

        <?php if (count($news) == 0) { ?>
            <h3>Новости отсутствуют</h3>
        <?php } ?>
            <?php for ($i = 0; $i < count($news); $i++) { ?>
                <div class="feature col">
                    <h3 class="fs-2"><?= $news[$i]['sagolovok'] ?></h3>
                    <?php foreach ($select as $row) { ?>
                        <!-- Условие для переноса новостей на след. строку -->
                        <?php for ($g = 0; $g < count($row); $g++) { ?>
                            <?php if ($news[$i]['id_kategori']==$row[$g]['id']) {  ?>
                                <p style="color: green;"><?= $row[$g]['nasvanie'] ?></p> <p>Дата подачи <?= $news[$i]['date'] ?></p>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <p><?= $news[$i]['info_news'] ?></p>


                    <div style="margin-left: 5px">
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
  <?= \yii\widgets\LinkPager::widget([
            'pagination'=>$pages,
    ]); ?>