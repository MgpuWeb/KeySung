<?php

namespace app\services\meeting\contract\models;

interface MeetingParticipantSummaryInterface
{
    public function getId(): int;
    public function getInvolvement(): float;
    public function getEmotions(): EmotionsInterface;
}