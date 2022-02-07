<?php

namespace app\services\meeting\contract;

use app\services\meeting\contract\filter\Filter;
use app\services\meeting\contract\models\MeetingItemInterface;

/**
 * Interface MeetingServiceInterface
 * @package app\services\meeting\contract
 * @todo: объединить поведение сервиса в один метод
 */
interface MeetingServiceInterface
{
    public function getById(string $id): ?models\MeetingInterface;
    public function getByIdWithMeta(string $id): ?models\MeetingInterface;

    /**
     * @param string $id
     * @return models\MeetingSummaryInterface|null
     */
    public function getSummary(string $id): ?models\MeetingSummaryInterface;

    /**
     * @param Filter[] $filters
     * @return MeetingItemInterface[]
     */
    public function getCollection(array $filters): array;
}