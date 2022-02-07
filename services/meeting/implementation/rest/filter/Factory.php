<?php

namespace app\services\meeting\implementation\rest\filter;

final class Factory implements \app\services\meeting\contract\filter\Factory
{
    public function order(string $attribute, string $order): Order
    {
        return new Order($attribute, $order);
    }

    public function value(string $attribute, int|float|bool|string $value): Value
    {
        return new Value($attribute, $value);
    }
}