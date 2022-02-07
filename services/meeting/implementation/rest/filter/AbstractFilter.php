<?php

namespace app\services\meeting\implementation\rest\filter;

use app\services\meeting\contract\filter\Filter;

abstract class AbstractFilter implements Filter
{
    public function __construct(private string $attribute)
    {
    }
    
    public function getAttribute(): string
    {
        return $this->attribute;
    }
    
    abstract public function toHttpQuery(): string;
}