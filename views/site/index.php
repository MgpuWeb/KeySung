<?php

/* @var $this yii\web\View */

use yii\bootstrap4\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Добро пожаловать в KeySung!</h1>

        <p class="lead">Для демонстрации введите идентификатор собрания.</p>

        <form action="<?= \yii\helpers\Url::to(['meetings/demo']) ?>">
            <div class="input-group mb-3">
                <input type="text" name="id" class="form-control" placeholder="Идентификатор собрания" aria-label="Идентификатор собрания" aria-describedby="button-addon2">
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Демонстрация</button>
            </div>
        </form>
    </div>
</div>
