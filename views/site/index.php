<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

    $this->title = 'Главная страница';

    ?>

    <title><?= Html::encode($this->title) ?></title>

<select class="form-select" aria-label="Пример выбора по умолчанию">
  <option selected disabled>Категории</option>
        <?php foreach ($select as $row) { ?>
            <option name="<?= $row['id'] ?>"><?= $row['nasvanie'] ?></option>
        <?php } ?>
</select>

<div class="row g-4 py-5 ">
      <div class="feature col">

        <h3 class="fs-2">Featured title</h3>
        <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
        <a href="#" class="icon-link">
          Call to action
        </a>
      </div>
      <div class="feature col">
        <h3 class="fs-2">Featured title</h3>
        <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
        <a href="#" class="icon-link">
          Call to action
        </a>
      </div>
    <div class="feature col">
        <h3 class="fs-2">Featured title</h3>
        <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
        <a href="#" class="icon-link">
          Call to action
        </a>
      </div>
    </div>
