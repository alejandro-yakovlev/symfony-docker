<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\Test;

use App\Shared\Domain\Service\ULIDService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Webmozart\Assert\Assert;

/**
 * Вопрос.
 */
class Question
{
    private string $id;

    private Test $test;

    private string $description;

    private int $positionNumber;

    private bool $isPublished = false;

    private QuestionType $type;

    /**
     * @var Collection<AnswerOption>
     */
    private Collection $answerOptions;

    public function __construct(Test $testing, string $description, int $positionNumber, QuestionType $type)
    {
        $this->id = ULIDService::generate();
        $this->test = $testing;
        $this->description = $description;
        $this->positionNumber = $positionNumber;
        $this->type = $type;
        $this->answerOptions = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Collection<AnswerOption>
     */
    public function getAnswerOptions(): Collection
    {
        return $this->answerOptions;
    }

    public function addAnswerOption(AnswerOption $answerOption): void
    {
        if ($answerOption->isCorrect() && QuestionType::MULTIPLE_CHOICE === $this->type) {
            foreach ($this->answerOptions as $answerOption) {
                Assert::false($answerOption->isCorrect(), 'Вопрос уже содержит правильный ответ');
            }
        }

        $this->answerOptions->add($answerOption);
    }
}
