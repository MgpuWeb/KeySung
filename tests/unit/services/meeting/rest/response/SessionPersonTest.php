<?php

namespace tests\unit\services\meeting\rest\response;

use app\services\meeting\implementation\rest\response\SessionPerson;
use Codeception\Test\Unit;

class SessionPersonTest extends Unit
{
	public function testGetId(): void
	{
		$id = 1;
		static::assertSame($id, (new SessionPerson($id, '::mainEmotion::'))->getId());
	}

	public function testGetPredominantEmotion(): void
	{
		$mainEmotion = '::mainEmotion::';
		static::assertSame($mainEmotion, (new SessionPerson(0, $mainEmotion))->getPredominantEmotion());
	}
}
