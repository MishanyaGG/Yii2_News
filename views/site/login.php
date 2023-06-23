<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    $this->title = 'Вход';
    ?>

    <title><?= Html::encode($this->title) ?></title>

   <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?= \yii\helpers\Url::to('login') ?>" class="nav-link active" aria-current="page">Для администратора</a></li>
      </ul>
    </header>
  </div>

<body class="text-center">

<?php if(isset($status)) { ?>
    <div class="alert alert-danger" role="alert">
        Неправильный логин или пароль
    </div>
<?php } ?>

<main class="form-signin">

    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model,'login')?>
        <?= $form->field($model,'pass')->passwordInput()?>
    <?= Html::submitButton('Вход',['class'=>'w-100 btn btn-lg btn-primary']) ?>
    <?php $form = ActiveForm::end() ?>

</main>

<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
