<?php

namespace App\Support\Enums;

enum Status: int
{
    case PENDING = 1;
    case APPROVED = 2;
    case REJECTED = 3;

    public function toString(): string
    {
        return match ($this) {
            self::PENDING => 'pending',
            self::APPROVED => 'approved',
            self::REJECTED => 'rejected',
        };
    }

    public function toColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::APPROVED => 'success',
            self::REJECTED => 'danger',
        };
    }
}
