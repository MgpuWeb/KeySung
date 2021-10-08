<?php

namespace app\services\meeting\contract\models;

interface MeetingParticipantInterface
{
    public function getId(): int;
    public function getMainEmotion(): string;
}