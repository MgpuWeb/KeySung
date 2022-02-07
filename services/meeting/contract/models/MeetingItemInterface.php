<?php

namespace app\services\meeting\contract\models;

use DateTimeInterface;

interface MeetingItemInterface
{
    public function getId(): string;
    public function getExternalId(): string;
    public function getCreatedAt(): DateTimeInterface;
}