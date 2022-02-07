<?php

namespace app\services\email\contract;

use app\services\user\contract\model\UserInterface;

interface EmailServiceInterface
{
    /**
     * @param UserInterface $user
     * @throws exception\SendingError
     * @return void
     */
    public function sendConfirmation(UserInterface $user): void;
}