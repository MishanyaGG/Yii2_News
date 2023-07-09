<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Редактирование новости';
?>

<!-- Заголовок -->
<title><?= Html::encode($this->title) ?></title>

 <ul class="nav nav-pills">
        <?php foreach ($pols as $arr) { ?>
            <li class="nav-item" style="margin-right: 10px"> <?= $arr[0]['login'] ?></li>
        <?php } ?>
        <li class="nav-item"><a href="<?= Url::to(['out']) ?>" class="nav-link active" aria-current="page">Выход</a></li>
    </ul>
    </header>
    </div>

<?= $form = Html::beginForm(['read_news','post']) ?>
    <div style="margin-left: 40%; display: inline-grid">
        <h2>Изменение новости</h2>
        <label>Категория новости</label>
        <?php foreach ($news as $news) { ?>
            <select class="form-select" name="kategory" style="margin: 5px">
                <?php foreach ($kategory as $kategory) { ?>
                    <?php for ($i = 0;$i<count($kategory);$i++) { ?>
                        <?php if ($news[0]['id_kategori']==$kategory[$i]['id']) { ?>
                            <option value="<?= $kategory[$i]['id'] ?>" selected><?= $kategory[$i]['nasvanie'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $kategory[$i]['id'] ?>"><?= $kategory[$i]['nasvanie'] ?></option>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </select>

            <input type="hidden" name="id_news" value="<?= $news[0]['id'] ?>">
            <input class="form-control" style="margin: 5px" type="text" value="<?= $news[0]['sagolovok'] ?>" required name="sagolovok" placeholder="Заголовок новости">
            <textarea class="form-control" name="info" required cols="15" style="resize: none; margin: 5px" rows="10"  placeholder="Краткая информация"><?= $news[0]['info_news'] ?></textarea>
        <?php } ?>
        <button class="btn btn-success" type="submit">Изменить</button>
    </div>

    <?= Html::endForm() ?>