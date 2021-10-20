<?php

namespace app\services\meeting\implementation\rest;

use app\services\meeting\contract;

final class Service implements contract\MeetingServiceInterface
{
    public function __construct(private Facade $facade)
    {
    }

    public function getById(string $id): ?contract\models\MeetingInterface
    {
		return $this->facade->getById($id);
    }
}