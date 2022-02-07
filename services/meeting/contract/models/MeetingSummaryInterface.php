<?php

namespace app\services\meeting\contract\models;

interface MeetingSummaryInterface
{
    public function getId(): string;

    /**
     * @return MeetingParticipantSummaryInterface[]
     */
    public function getParticipants(): array;
}