<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\Test;

/**
 * Уровень сложности теста.
 */
enum DifficultyLevel: string
{
    /*
     * Легкий.
     */
    case EASY = 'easy';
    /*
     * Средний.
     */
    case MEDIUM = 'medium';
    /*
     * Сложный.
     */
    case HARD = 'hard';
}
