<?php

namespace app\services\meeting\contract\filter;

interface Order extends Filter
{
    public function getOrder(): string;
}