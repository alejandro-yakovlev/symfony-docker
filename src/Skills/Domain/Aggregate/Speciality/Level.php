<?php

namespace App\Skills\Domain\Aggregate\Speciality;

/**
 * Требуемый уровень владения навыком в специальности.
 */
enum Level: string
{
    case BEGINNER = 'beginner';

    case INTERMEDIATE = 'intermediate';

    case ADVANCED = 'advanced';

    case EXPERT = 'expert';
}
