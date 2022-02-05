<?php

namespace app\services\user\implementation;

use app\services\user\contract as userContract;
use app\services\email\contract as emailContract;
use app\services\user\contract\model;

final class Service implements userContract\UserServiceInterface
{
    public function __construct(
        private userContract\UserRepositoryInterface $userRepository,
        private emailContract\EmailServiceInterface $emailService
    ) {}

    public function create(userContract\model\UserInterface $user): userContract\model\UserInterface
    {
        $user = $this->userRepository->create($user);

        $this->emailService->sendConfirmation($user);

        return $user;
    }

    public function confirmEmail(string $confirmationToken): userContract\model\UserInterface
    {
        return $this->userRepository->confirmEmail($confirmationToken);
    }

    public function authenticate(string $email, string $password): model\UserInterface|null
    {
        $user = $this->userRepository->getByCredentials($email, $password);
        if ($user === null) {
            return null;
        }

        return $this->userRepository->refreshAccessToken($user);
    }
}