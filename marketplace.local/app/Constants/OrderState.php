<?php

namespace App\Constants;

enum OrderState: string
{
    use EnumToArray;
    case DRAFT = "draft";
    case PENDING = "pending";
    case ORDERED = "ordered";
}
