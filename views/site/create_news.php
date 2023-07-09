<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Добавление новостей';
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

    <?= $form = Html::beginForm(['create_news','post']) ?>
    <div style="margin-left: 40%; display: inline-grid">
        <h2>Добавление новости</h2>
        <label>Категория новости</label>
        <select name="kategory" style="margin: 10px">
            <?php foreach ($kategory as $kategory) { ?>
                <?php for ($i = 0;$i<count($kategory);$i++) { ?>
                    <option value="<?= $kategory[$i]['id'] ?>"><?= $kategory[$i]['nasvanie'] ?></option>
                <?php } ?>
            <?php } ?>
        </select>
        <input style="margin: 10px" type="text" required name="sagolovok" placeholder="Заголовок новости">
        <textarea name="info" required cols="10" style="resize: none; margin: 10px" rows="5"  placeholder="Краткая информация"></textarea>
        <button class="btn btn-success" type="submit">Создать</button>
    </div>

<?= Html::endForm() ?>
