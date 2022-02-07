<?php

namespace app\services\user\implementation;

use app\models\enum\user\Status;
use app\models\User;
use app\services\user\contract;
use app\services\user\contract\exception;
use app\services\user\contract\model;
use Ramsey\Uuid\Uuid;

final class Repository implements contract\UserRepositoryInterface
{
    /**
     * @param contract\model\UserInterface|User $user
     * @return void
     */
    public function create(contract\model\UserInterface $user): contract\model\UserInterface
    {
        $user->setScenario(User::SCENARIO_REGISTRATION);
        $user->password = \Yii::$app->security->generatePasswordHash($user->password);
        $user->status = Status::UNCONFIRMED;

        if (!$user->save()) {
            throw new contract\exception\repository\InvalidEntity($user->getErrorSummary(true)[0]);
        }

        return $user;
    }

    public function confirmEmail(string $confirmationToken): contract\model\UserInterface
    {
        $user = User::findOne(['email_confirmation_token' => $confirmationToken]);

        if ($user === null) {
            throw new contract\exception\repository\NotFound();
        }

        $user->status = Status::CONFIRMED;
        $user->remember_me_token = null;
        $user->save();

        return $user;
    }

    public function getByCredentials(string $email, string $password): model\UserInterface|null
    {
        $user = User::findOne(['email' => $email]);
        if ($user !== null) {
            if (\Yii::$app->security->validatePassword($password, $user->getPassword())) {
                return $user;
            }
        }

        return null;
    }

    /**
     * @param model\UserInterface|User $user
     * @return model\UserInterface|User
     */
    public function refreshAccessToken(model\UserInterface $user): model\UserInterface
    {
        $user->setAccessToken(Uuid::uuid4());
        $user->save();
        return $user;
    }
}