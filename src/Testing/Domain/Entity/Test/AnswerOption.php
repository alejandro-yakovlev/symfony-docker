<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\Test;

use App\Shared\Domain\Service\UlidService;

/**
 * Вариант ответа на вопрос.
 */
class AnswerOption
{
    private string $id;

    private Question $question;

    private string $description;

    /**
     * Является ли ответ правильным?
     */
    private bool $isCorrect;

    public function __construct(Question $question, string $description, bool $isCorrect)
    {
        $this->id = UlidService::generate();
        $this->question = $question;
        $this->description = $description;
        $this->isCorrect = $isCorrect;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}
