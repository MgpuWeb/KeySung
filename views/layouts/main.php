<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);

    $navbarItems = [
        ['label' => 'Meetings Collection', 'url' => ['/meetings']],
        ['label' => 'Rest Api Documentation', 'url' => ['/site/api-docs']],
        ['label' => 'Integration Rest Api Documentation', 'url' => ['/site/integration-api-docs']],
        Yii::$app->user->isGuest ? ['label' => 'Login', 'url' => ['/site/login']] : ['label' => 'Logout', 'url' => ['/site/logout']],
    ];

    if (Yii::$app->user->isGuest) {
        $navbarItems[] = ['label' => 'Sign Up', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $navbarItems,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; KeySung <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
