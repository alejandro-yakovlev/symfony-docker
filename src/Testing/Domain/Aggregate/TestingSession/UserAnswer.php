<?php

declare(strict_types=1);

namespace App\Testing\Domain\Aggregate\TestingSession;

use App\Shared\Domain\Service\UlidService;
use App\Testing\Domain\Aggregate\Test\AnswerOption;
use App\Testing\Domain\Aggregate\Test\Question;

class UserAnswer
{
    private string $id;

    private TestingSession $testingSession;

    private Question $question;

    private array $answeredOptions = [];

    public function __construct(TestingSession $testingSession, Question $question)
    {
        $this->id = UlidService::generate();
        $this->testingSession = $testingSession;
        $this->question = $question;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function isCorrect(): bool
    {
        foreach ($this->question->getAnswerOptions() as $answerOption) {
            if ($answerOption->isCorrect() && in_array($answerOption->getId(), $this->answeredOptions, true)) {
                return true;
            }
        }

        return false;
    }

    public function addAnswerOption(AnswerOption $answerOption): void
    {
        $this->answeredOptions[$answerOption->getId()] = $answerOption->getId();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTestingSession(): TestingSession
    {
        return $this->testingSession;
    }
}
