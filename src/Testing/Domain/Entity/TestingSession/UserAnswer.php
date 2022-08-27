<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\TestingSession;

use App\Shared\Domain\Service\ULIDService;
use App\Testing\Domain\Entity\Test\AnswerOption;
use App\Testing\Domain\Entity\Test\Question;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class UserAnswer
{
    private string $id;

    private TestingSession $testingSession;

    private Question $question;

    /**
     * @var Collection<AnswerOption>
     */
    private Collection $answerOptions;

    public function __construct(TestingSession $testingSession, Question $question)
    {
        $this->id = ULIDService::generate();
        $this->testingSession = $testingSession;
        $this->question = $question;
        $this->answerOptions = new ArrayCollection();
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function isCorrect(): bool
    {
        foreach ($this->question->getAnswerOptions() as $answerOption) {
            if ($answerOption->isCorrect() && !$this->answerOptions->contains($answerOption)) {
                return false;
            }
        }

        return true;
    }

    public function addAnswerOption(AnswerOption $answerOption): void
    {
        $this->answerOptions->add($answerOption);
    }
}
