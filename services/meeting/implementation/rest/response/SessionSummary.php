<?php

namespace app\services\meeting\implementation\rest\response;

use app\services\meeting\contract;

final class SessionSummary implements contract\models\MeetingSummaryInterface
{
    /**
     * SessionsSummary constructor.
     * @param string $id
     * @param contract\models\MeetingParticipantSummaryInterface[] $participants
     */
    public function __construct(private string $id, private array $participants)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getParticipants(): array
    {
        return $this->participants;
    }
}