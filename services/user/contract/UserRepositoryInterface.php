<?php

namespace app\services\user\contract;

interface UserRepositoryInterface
{
    /**
     * @param model\UserInterface $user
     * @throws exception\repository\InvalidEntity
     */
    public function create(model\UserInterface $user): model\UserInterface;

    /**
     * @param string $confirmationToken
     * @return model\UserInterface
     * @throws exception\repository\NotFound
     */
    public function confirmEmail(string $confirmationToken): model\UserInterface;

    public function getByCredentials(string $email, string $password): model\UserInterface|null;

    /**
     * @param model\UserInterface $user
     * @return model\UserInterface
     * @throws exception\repository\NotFound
     */
    public function refreshAccessToken(model\UserInterface $user): model\UserInterface;
}