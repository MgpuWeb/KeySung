<?php

namespace app\services\user\contract;

interface UserServiceInterface
{
    /**
     * @param model\UserInterface $user
     * @throws exception\repository\InvalidEntity
     * @return void
     */
    public function create(model\UserInterface $user): model\UserInterface;

    /**
     * @param string $confirmationToken
     * @throws exception\repository\NotFound
     * @return void
     */
    public function confirmEmail(string $confirmationToken): model\UserInterface;

    public function authenticate(string $email, string $password): model\UserInterface|null;
}