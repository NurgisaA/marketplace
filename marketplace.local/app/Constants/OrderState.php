<?php

namespace App\Constants;

use App\Traits\EnumToArray;

enum OrderState: string
{
    use EnumToArray;
    case DRAFT = "draft";
    case PENDING = "pending";
    case ORDERED = "ordered";
}
