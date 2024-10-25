<?php
namespace App\Enums;

enum TaskStatus: string
{
    case PREPARATION = 'preparation';
    case IN_PROGRESS = 'in_progress';
    case IN_REVIEW = 'in_review';
    case COMPLETED = 'completed';

    // Método para exibir o rótulo em português
    public function label(): string
    {
        return match($this) {
            TaskStatus::PREPARATION => 'Preparação',
            TaskStatus::IN_PROGRESS => 'Em andamento',
            TaskStatus::IN_REVIEW => 'Em revisão',
            TaskStatus::COMPLETED => 'Concluído',
        };
    }

    // Método para listar as opções disponíveis, útil para formulários
    public static function options(): array
    {
        return [
            self::PREPARATION->value => self::PREPARATION->label(),
            self::IN_PROGRESS->value => self::IN_PROGRESS->label(),
            self::IN_REVIEW->value => self::IN_REVIEW->label(),
            self::COMPLETED->value => self::COMPLETED->label(),
        ];
    }
}
