<?php

namespace app\services\meeting\contract\models;

interface MeetingParticipantInterface
{
    public function getId(): int;
    public function getPredominantEmotion(): ?string;
    public function getAvatarPath(): ?string;

    /**
	 * @todo: контракт изменился из-за смысловых несостыковок
	 * @see \app\services\meeting\implementation\rest\Service::getByIdWithMeta()
	 */
    public function setAvatarPath(string $avatarPath): void;
}