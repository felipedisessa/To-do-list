<?php
namespace App\Enums;

enum TaskPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    // Método para exibir o rótulo em português
    public function label(): string
    {
        return match($this) {
            TaskPriority::LOW => 'Baixa',
            TaskPriority::MEDIUM => 'Média',
            TaskPriority::HIGH => 'Alta',
        };
    }

    // Método para listar as opções disponíveis, útil para formulários
    public static function options(): array
    {
        return [
            self::LOW->value => self::LOW->label(),
            self::MEDIUM->value => self::MEDIUM->label(),
            self::HIGH->value => self::HIGH->label(),
        ];
    }
}
