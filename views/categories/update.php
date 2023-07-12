<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Categories $model */
$this->title = 'Изменение названия категории';

?>
<div class="categories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
