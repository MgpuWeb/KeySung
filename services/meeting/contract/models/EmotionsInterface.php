<?php

namespace app\services\meeting\contract\models;

interface EmotionsInterface
{
    public function getAngry(): float;
    public function getHappy(): float;
    public function getNeutral(): float;
    public function getSad(): float;
    public function getSurprise(): float;
}