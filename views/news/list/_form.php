<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\News $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="news-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'header')->textInput()->label('Заголовок') ?>

    <?= $form->field($model, 'id_categories')->dropDownList([
        \yii\helpers\ArrayHelper::map(\app\models\Categories::find()->all(),'id','name_of_category')
    ])->label('Категория новости')?>

    <?= $form->field($model, 'information')->textarea(['rows'=>6,'style'=>'resize: none'])->label('Информация') ?>

    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
