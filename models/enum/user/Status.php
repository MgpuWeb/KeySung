<?php

namespace app\models\enum\user;

use MyCLabs\Enum\Enum;

class Status extends Enum
{
    public const UNCONFIRMED = 0;
    public const CONFIRMED   = 1;
}