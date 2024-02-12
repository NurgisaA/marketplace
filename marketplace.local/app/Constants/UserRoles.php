<?php

namespace App\Constants;

enum UserRoles: string
{
    use EnumToArray;
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';
}
