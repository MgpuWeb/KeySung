<?php
use yii\helpers\Html;

/* @var $user \app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/signup-confirm', 'token' => $user->email_confirmation_token]);
?>
<div class="password-reset">
    <p>Hello!</p>

    <p>Follow the link below to confirm your email:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>