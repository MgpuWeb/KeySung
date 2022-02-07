<?php

namespace app\services\meeting\implementation\rest\response;

use app\services\meeting\contract\models\EmotionsInterface;
use app\services\meeting\contract\models\MeetingParticipantSummaryInterface;

final class SessionPersonSummary implements MeetingParticipantSummaryInterface
{
    public function __construct(private int $id, private float $involvement, private EmotionsInterface $emotions)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getInvolvement(): float
    {
        return $this->involvement;
    }

    public function getEmotions(): EmotionsInterface
    {
        return $this->emotions;
    }
}