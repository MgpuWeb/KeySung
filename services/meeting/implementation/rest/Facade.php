<?php

namespace app\services\meeting\implementation\rest;

use app\services\meeting\implementation\rest\filter\AbstractFilter;
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

    /**
     * @param string $id
     * @return response\SessionSummary|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
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

    /**
     * @param AbstractFilter[] $filters
     * @return response\SessionItem[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function getCollection(array $filters): array
    {
//        $endpointUrl = sprintf('/%s?%s', static::ENDPOINT_SESSIONS, $this->filtersToHttpQuery($filters));
//
//        try {
//            $response = $this->client->get($endpointUrl);
//        } catch (ClientException) {
//            return [];
//        }
//
//        $jsonDecodedResponse = json_decode(
//            $response->getBody()->getContents(),
//            true,
//            512,
//            JSON_THROW_ON_ERROR
//        );

        $jsonDecodedResponse = [
            [
                'id' => 1,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaef',
                'created_at' => '2020-08-17T18:32:28.349Z',
            ],
            [
                'id' => 2,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaea',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 3,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaec',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 4,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaee',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 1,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaef',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 2,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaea',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 3,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaec',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 4,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaee',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 1,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaef',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 2,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaea',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 3,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaec',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 4,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaee',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 1,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaef',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 2,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaea',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 3,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaec',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
            [
                'id' => 4,
                'external_id' => 'aefaefaef-aefaef-aefaefa-aefaee',
                'created_at' => '1947-08-17T18:32:28.349Z',
            ],
        ];

        return $this->responseFactory->createSessionItems($jsonDecodedResponse);
    }

    /**
     * @param AbstractFilter[] $filters
     * @return string
     */
    private function filtersToHttpQuery(array $filters): string
    {
        return array_reduce(
            $filters,
            static function (?string $httpQuery, AbstractFilter $filter): string {
                return $httpQuery === null ? $filter->toHttpQuery() : "{$httpQuery}&{$filter->toHttpQuery()}";
            }
        );
    }
}