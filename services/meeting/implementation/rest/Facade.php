<?php

namespace app\services\meeting\implementation\rest;

class Facade
{
	private const ENDPOINT_SESSIONS = 'sessions';

    public function __construct(private Client $client, private response\Factory $responseFactory)
    {
    }

    public function getById(string $id): response\Session
    {
    	$endpointUrl = sprintf('%s/%s', static::ENDPOINT_SESSIONS, $id);
		$response = $this->client->get($endpointUrl);
		$jsonDecodedResponse = json_decode(
			$response->getBody()->getContents(),
			true,
			512,
			JSON_THROW_ON_ERROR
		);

		return $this->responseFactory->createSession($jsonDecodedResponse);
    }
}