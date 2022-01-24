<?php

namespace app\services\meeting\implementation\rest\response;

use DateTimeImmutable;
use JetBrains\PhpStorm\Pure;

class Factory
{
	public function createSession(array $response): Session
	{
		$persons = array_map(static function(array $person): SessionPerson {
		    return new SessionPerson(
		        $person['id'],
                $person['main_emotion'] ?? null,
                $person['avatar_path'] ?? null
            );
		}, $response['persons']);

		return new Session($response['id'], $persons);
	}

    public function createSessionSummary(array $response): SessionSummary
    {
        $persons = array_map(function (array $person): SessionPersonSummary {
            return new SessionPersonSummary($person['person_id'], $person['involvement'], $this->createEmotions($person['emotions']));
        }, $response['persons']);

        return new SessionSummary($response['id'], $persons);
    }

    /**
     * @return SessionItem[]
     */
    public function createSessionItems(array $response): array
    {
        return array_map(static function (array $item): SessionItem {
            return new SessionItem($item['session_id'], $item['external_id'], new DateTimeImmutable($item['created_at']));
        }, $response);
    }

    #[Pure] private function createEmotions(array $emotions): Emotions
    {
        return new Emotions(
            $emotions['angry'] ?? 0.0,
            $emotions['happy'] ?? 0.0,
            $emotions['neutral'] ?? 0.0,
            $emotions['sad'] ?? 0.0,
            $emotions['surprise'] ?? 0.0,
        );
    }
}