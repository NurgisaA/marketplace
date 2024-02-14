<?php

namespace App\Constants;

enum UserRoles: string
{
    use EnumToArray;
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';

    public static function getAdmins(): array
    {
        return [self::ADMIN->value, self::MODERATOR->value];
    }
}
