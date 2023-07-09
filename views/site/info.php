<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

foreach ($info as $info) {
    $this->title = $info[0]['sagolovok'];
}
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

    <div style="margin-left: 3%">
        <?php foreach ($info as $info) { ?>
        <h1><?= $info['sagolovok'] ?></h1>
        <p style="color: green;"><?= $info['nasvanie'] ?></p>
        <p><?= $info['info_news'] ?></p>
    <?php } ?>
    </div>

    <!-- Если вошли в аккаунт -->
<?php } else { ?>
    <ul class="nav nav-pills">
        <?php foreach ($pols as $arr) { ?>
            <li class="nav-item" style="margin-right: 10px"> <?= $arr[0]['login'] ?></li>
        <?php } ?>
        <li class="nav-item"><a href="<?= Url::to(['out']) ?>" class="nav-link active" aria-current="page">Выход</a></li>
    </ul>
    </header>
    </div>

    <?php foreach ($info as $info) { ?>
        <h1><?= $info['sagolovok'] ?></h1>
        <p style="color: green;"><?= $info['nasvanie'] ?></p>
        <p><?= $info['info_news'] ?></p>
    <?php } ?>

<?php } ?>