<?php

namespace app\services\implementation\rest;

use app\services\meeting\contract;

class Service implements contract\MeetingServiceInterface
{
    public function __construct(private Facade $facade)
    {
    }

    public function getById(string $id): contract\models\MeetingInterface
    {

    }
}