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

    public static function options(): array
    {
        return [
            self::User->value => self::User->label(),
            self::Admin->value => self::Admin->label(),
        ];
    }
}
