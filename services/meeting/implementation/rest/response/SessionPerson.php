<?php

namespace app\services\meeting\implementation\rest\response;

use app\services\meeting\contract\models\MeetingParticipantInterface;

final class SessionPerson implements MeetingParticipantInterface
{
	public function __construct(private int $id, private ?string $mainEmotion = null, private ?string $avatarPath = null)
	{
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPredominantEmotion(): ?string
	{
		return $this->mainEmotion;
	}

	public function getAvatarPath(): ?string
	{
		return $this->avatarPath;
	}

	public function setAvatarPath(string $avatarPath): void
	{
		$this->avatarPath = $avatarPath;
	}
}