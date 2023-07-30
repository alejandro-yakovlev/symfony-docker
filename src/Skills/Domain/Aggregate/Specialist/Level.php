<?php

namespace App\Skills\Domain\Aggregate\Specialist;

/**
 * Уровень владения навыком
 */
enum Level: string
{
    /*
     * Не знаю.
     */
    case DONT_KNOW = 'dont_know';

    /*
     * Начинающий.
     */
    case BEGINNER = 'beginner';

    /*
     * Средний.
     */
    case INTERMEDIATE = 'intermediate';

    /*
     * Продвинутый.
     */
    case ADVANCED = 'advanced';

    /*
     * Экспертный.
     */
    case EXPERT = 'expert';
}
