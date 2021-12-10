<?php

namespace app\services\meeting\contract\filter;

interface Filter
{
    public function getAttribute(): string;
}