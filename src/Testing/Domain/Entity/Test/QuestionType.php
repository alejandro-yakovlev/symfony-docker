<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\Test;

/**
 * Тип вопроса.
 */
enum QuestionType: string
{
    /*
     * Один ответ из списка.
     */
    case MULTIPLE_CHOICE = 'multiple_choice';
    /*
     * Несколько ответов из списка.
     */
    case MULTIPLE_RESPONSE = 'multiple_response';
}
