<?php

namespace app\services\meeting\implementation\rest\response;

use app\services\meeting\contract\models\MeetingItemInterface;
use DateTimeInterface;

class SessionItem implements MeetingItemInterface
{
    public function __construct(private string $id, private string $externalId, private DateTimeInterface $createdAt)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}