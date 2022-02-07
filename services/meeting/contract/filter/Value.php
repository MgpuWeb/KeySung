<?php

namespace app\services\meeting\contract\filter;

interface Value extends Filter
{
    public function getValue(): int|float|bool|string;
}