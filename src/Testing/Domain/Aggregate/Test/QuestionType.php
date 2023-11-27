<?php

declare(strict_types=1);

namespace App\Testing\Domain\Aggregate\Test;

/**
 * Тип вопроса.
 */
enum QuestionType: string
{
    case SINGLE_CHOICE = 'SINGLE_CHOICE';

    case MULTIPLE_CHOICE = 'MULTIPLE_CHOICE';

    case FILL_IN_THE_BLANKS = 'FILL_IN_THE_BLANKS';
    case TRUE_FALSE = 'TRUE_FALSE';
    case MATCHING = 'MATCHING';
    case SHORT_ANSWER = 'SHORT_ANSWER';
    case ESSAY = 'ESSAY';
    case PROBLEM_SOLVING = 'PROBLEM_SOLVING';
    case CASE_STUDY = 'CASE_STUDY';
    case PRACTICAL_TASK = 'PRACTICAL_TASK';
}
