<?php

namespace app\services\meeting\implementation\rest\response;

use app\services\meeting\contract;

/**
 * Class Session
 * @package app\services\meeting\implementation\rest\response
 */
final class Session implements contract\models\MeetingInterface
{
	public function __construct(private string $id, private array $persons)
	{
	}

	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return contract\models\MeetingParticipantInterface[]
	 */
	public function getParticipants(): array
	{
		return $this->persons;
	}
}