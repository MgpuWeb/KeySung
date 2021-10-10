<?php

namespace app\services\meeting\implementation\rest\response;

use app\services\meeting\contract;

/**
 * Class Session
 * @package app\services\meeting\implementation\rest\response
 * @property SessionPerson[] $members
 * @todo: На кой чёрт создавать DTO имплементирующий интерфейс, получается на каждую имплементацию сервиса придётся создавать эти DTO,хотя по факту они будут одинаковые
 */
final class Session implements contract\models\MeetingInterface
{
	public function __construct(private string $name, private array $persons)
	{
	}

	public function getId(): string
	{
		return $this->name;
	}

	/**
	 * @return contract\models\MeetingParticipantInterface[]
	 */
	public function getParticipants(): array
	{
		return $this->persons;
	}
}