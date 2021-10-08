<?php

namespace app\services\meeting\contract\models;

interface MeetingInterface
{
    public function getId(): string;

    /**
     * @return MeetingParticipantInterface[]
     */
    public function getParticipants(): array;
}