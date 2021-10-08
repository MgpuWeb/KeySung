<?php

namespace app\services\implementation\rest;

class Facade
{
    public function __construct(private Client $client)
    {
    }

    public function getById(string $id): response\Meeting
    {

    }
}