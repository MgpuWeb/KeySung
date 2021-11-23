<?php

namespace app\services\meeting\implementation\rest;

use GuzzleHttp\Exception\ClientException;

class Facade
{
	private const ENDPOINT_SESSIONS = 'sessions';

    public function __construct(private Client $client, private response\Factory $responseFactory)
    {
    }

	/**
	 * @param string $id
	 * @return response\Session|null
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \JsonException
	 * @todo: при расширении запросов перенести обработку в клиент
	 */
    public function getById(string $id): ?response\Session
    {
    	$endpointUrl = sprintf('/%s/%s', static::ENDPOINT_SESSIONS, $id);

		try {
			$response = $this->client->get($endpointUrl);
		} catch (ClientException) {
			return null;
		}

		$jsonDecodedResponse = json_decode(
			$response->getBody()->getContents(),
			true,
			512,
			JSON_THROW_ON_ERROR
		);

		return $this->responseFactory->createSession($jsonDecodedResponse);
    }

	public function getMetaById(string $id): ?response\Session
	{
		$endpointUrl = sprintf('/%s/%s/meta', static::ENDPOINT_SESSIONS, $id);

		try {
			$response = $this->client->get($endpointUrl);
		} catch (ClientException) {
			return null;
		}

		$jsonDecodedResponse = json_decode(
			$response->getBody()->getContents(),
			true,
			512,
			JSON_THROW_ON_ERROR
		);

		return $this->responseFactory->createSession($jsonDecodedResponse);
	}

	public function getSummary(string $id): ?response\SessionSummary
    {
        $endpointUrl = sprintf('/%s/%s/summary', static::ENDPOINT_SESSIONS, $id);

        try {
            $response = $this->client->get($endpointUrl);
        } catch (ClientException) {
            return null;
        }

        $jsonDecodedResponse = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        return $this->responseFactory->createSessionSummary($jsonDecodedResponse);
    }
}