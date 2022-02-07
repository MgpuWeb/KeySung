<?php

namespace app\services\email\implementation;

use app\services\email\contract as emailContract;
use app\services\user\contract as userContract;
use Yii;

class Service implements emailContract\EmailServiceInterface
{
    public function sendConfirmation(userContract\model\UserInterface $user): void
    {
        $sent = Yii::$app->mailer
            ->compose(
                ['html' => 'sign_up/confirmation'],
                ['user' => $user])
            ->setTo($user->getEmail())
            ->setFrom(Yii::$app->params['mailer']['emails']['application'])
            ->setSubject('Confirmation of registration')
            ->send();

        if (!$sent) {
            throw new emailContract\exception\SendingError();
        }
    }
}