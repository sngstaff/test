<?php

namespace App\Enums;

enum AuthTokenScopesEnum: string
{
    case ADMIN = 'admin';
    case WEB = 'web';
}
