<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\Test;

use App\Shared\Domain\Service\ULIDService;

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
        $this->id = ULIDService::generate();
        $this->question = $question;
        $this->description = $description;
        $this->isCorrect = $isCorrect;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
