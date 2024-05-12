<?php

namespace App\Support\Enums;

enum Roles: int
{
    case ADMIN = 1;
    case UPLOADER = 2;
    case VALIDATOR = 3;

    public function toString(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::UPLOADER => 'Uploader',
            self::VALIDATOR => 'Validator',
        };
    }
}
