<?php

namespace app\services\meeting\contract;

interface MeetingServiceInterface
{
    public function getById(string $id): models\MeetingInterface;
}