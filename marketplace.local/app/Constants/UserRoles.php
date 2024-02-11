<?php

namespace App\Constants;

enum UserRoles: string
{
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';
}
