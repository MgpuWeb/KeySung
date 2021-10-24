<?php

namespace app\services\meeting\implementation\rest\response;

use JetBrains\PhpStorm\Pure;

class Factory
{
	public function createSession(array $response): Session
	{
		$persons = array_map(function(array $person): SessionPerson {
			return $this->createSessionPerson($person['id'], $person['main_emotion'] ?? null, $person['avatar_path'] ?? null);
		}, $response['persons']);

		return new Session($response['id'], $persons);
	}

	#[Pure] private function createSessionPerson(int $id, ?string $mainEmotion, ?string $avatarPath): SessionPerson
	{
		return new SessionPerson($id, $mainEmotion, $avatarPath);
	}
}