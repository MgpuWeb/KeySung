<?php

namespace app\services\meeting\contract\filter;

interface Factory
{
    public function order(string $attribute, string $order): Order;
    public function value(string $attribute, int|float|bool|string $value): Value;
}