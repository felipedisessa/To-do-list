<?php

namespace App\Enums;

enum UserRole: string
{
    case User = 'user';
    case Admin = 'admin';

    public function label(): string
    {
        return match($this) {
            self::User => 'Comum',
            self::Admin => 'Administrador',
        };
    }
}
