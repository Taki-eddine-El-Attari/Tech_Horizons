<?php

namespace App\Enumérations;

enum Role: string
{
    case Editeur = 'Éditeur';
    case Responsable = 'Responsable';
    case Abonne = 'Abonné';

    public function label(): string
    {
        return match ($this) {
            self::Abonne => 'Abonné',
            self::Responsable => 'Responsable',
            self::Editeur => 'Éditeur',
        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
