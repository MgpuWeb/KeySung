<?php

namespace app\services\user\contract\model;

interface UserInterface
{
    public function getId(): int;
    public function getEmail(): string;
    public function setEmail(string $email): void;
    public function getPassword(): string;
    public function setPassword(string $password): void;
    public function getStatus(): int;
    public function setStatus(int $status): void;
    public function getAccessToken(): string;
    public function setAccessToken(string $token): void;
}