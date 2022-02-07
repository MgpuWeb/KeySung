<?php

namespace app\services\meeting\implementation\rest\response;

use app\services\meeting\contract\models\EmotionsInterface;

final class Emotions implements EmotionsInterface
{
    public function __construct(
        private float $angry,
        private float $happy,
        private float $neutral,
        private float $sad,
        private float $surprise,
    )
    {
    }

    public function getAngry(): float
    {
        return $this->angry;
    }

    public function getHappy(): float
    {
        return $this->happy;
    }

    public function getNeutral(): float
    {
        return $this->neutral;
    }

    public function getSad(): float
    {
        return $this->sad;
    }

    public function getSurprise(): float
    {
        return $this->surprise;
    }
}