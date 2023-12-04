<?php

declare(strict_types=1);

namespace App\Testing\Domain\Aggregate\Test;

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
    private bool $correct;

    public function __construct(Question $question, string $description, bool $isCorrect)
    {
        $this->id = UlidService::generate();
        $this->question = $question;
        $this->description = $description;
        $this->correct = $isCorrect;
    }

    public function isCorrect(): bool
    {
        return $this->correct;
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
