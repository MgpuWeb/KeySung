<?php

namespace tests\unit\services\meeting\rest;

use app\services\meeting\implementation\rest;
use Codeception\Test\Unit;

class ServiceTest extends Unit
{
    public function testAon()
    {
        var_dump(http_build_query(['order[age]' => 'desc']));
    }

	public function testGetByIdWhenSuccess(): void
	{
		$facade = $this->createMock(rest\Facade::class);

		$id = '::sessionId::';
		$meeting = new rest\response\Session($id, []);
		$facade->expects(static::once())
			->method('getById')
			->with($id)
			->willReturn($meeting);

		$service = new rest\Service($facade);
		static::assertSame($meeting, $service->getById($id));
	}

	public function testGetByIdWhenFails(): void
	{
		$facade = $this->createMock(rest\Facade::class);

		$id = '::sessionId::';
		$facade->expects(static::once())
			->method('getById')
			->with($id)
			->willReturn(null);

		$service = new rest\Service($facade);
		static::assertNull($service->getById($id));
	}
}
