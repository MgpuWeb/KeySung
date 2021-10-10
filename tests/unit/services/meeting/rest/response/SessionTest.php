<?php

namespace tests\unit\services\meeting\rest\response;

use app\services\meeting\implementation\rest\response\Session;
use app\services\meeting\implementation\rest\response\SessionPerson;
use Codeception\Test\Unit;

class SessionTest extends Unit
{
	public function testGetId()
	{
		$id = '::id::';
		self::assertSame($id, (new Session($id, []))->getId());
	}

	public function testGetParticipants()
	{
		$participants = [
			new SessionPerson(1, '::someEmotion::'),
			new SessionPerson(2, '::someAnotherEmotion::'),
		];

		self::assertSame($participants, (new Session('::id::', $participants))->getParticipants());
	}
}
