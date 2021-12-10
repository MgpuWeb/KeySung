<?php

namespace app\services\meeting\implementation\rest\filter;

use app\services\meeting\contract;
use JetBrains\PhpStorm\Pure;

class Value extends AbstractFilter implements contract\filter\Value
{
    public function __construct(string $attribute, private int|float|bool|string $value)
    {
        parent::__construct($attribute);
    }

    public function getValue(): int|float|bool|string
    {
        return $this->value;
    }

    #[Pure] public function toHttpQuery(): string
    {
        return http_build_query([$this->getAttribute() => $this->value]);
    }
}