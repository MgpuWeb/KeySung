<?php

namespace tests\unit\services\meeting\rest\response;

use app\services\meeting\implementation\rest\response;
use Codeception\Test\Unit;

class FactoryTest extends Unit
{
	public function testCreateSession(): void
	{
		$sessionId = '::sessionId::';
		$personId = 0;
		$personMainEmotion = '::personMainEmotion::';

		$response = [
			'id' => $sessionId,
			'persons' => [
				[
					'id' => $personId,
					'main_emotion' => $personMainEmotion,
				],
			],
		];

		$factory = new response\Factory();
		static::assertEquals(
			new response\Session(
				$sessionId,
				[
					new response\SessionPerson($personId, $personMainEmotion)
				]
			),
			$factory->createSession($response)
		);
	}
}
