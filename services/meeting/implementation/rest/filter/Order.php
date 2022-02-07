<?php

namespace app\services\meeting\implementation\rest\filter;

use app\services\meeting\contract;
use JetBrains\PhpStorm\Pure;

final class Order extends AbstractFilter implements contract\filter\Order
{
    public function __construct(string $attribute, private string $order)
    {
        parent::__construct($attribute);
    }
    
    public function getOrder(): string 
    {
        return $this->order;
    }

    #[Pure] public function toHttpQuery(): string
    {
        return http_build_query(["order[{$this->getAttribute()}]" => $this->order]);
    }
}