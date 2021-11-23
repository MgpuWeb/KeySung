<?php

namespace app\services\meeting\contract;

/**
 * Interface MeetingServiceInterface
 * @package app\services\meeting\contract
 * @todo: объединить поведение сервиса в один метод
 */
interface MeetingServiceInterface
{
    public function getById(string $id): ?models\MeetingInterface;
    public function getByIdWithMeta(string $id): ?models\MeetingInterface;
    public function getSummary(string $id): ?models\MeetingSummaryInterface;
}