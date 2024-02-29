<?php

namespace App\Constants;

use App\Traits\EnumToArray;

enum UserRoles: string
{
    use EnumToArray;
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';


    public static function getAdmins(): array
    {
        return [self::MODERATOR->value, self::ADMIN->value];
    }
}
