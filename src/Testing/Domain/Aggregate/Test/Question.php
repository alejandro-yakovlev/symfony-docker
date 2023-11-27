<?php

declare(strict_types=1);

namespace App\Testing\Domain\Aggregate\Test;

use App\Shared\Domain\Service\UlidService;
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

    private string $name;

    private string $description;

    private ?int $positionNumber = null;

    private bool $published = false;

    private QuestionType $type;

    /**
     * @var Collection<AnswerOption>
     */
    private Collection $answerOptions;

    public function __construct(Test $test, string $name, string $description, QuestionType $type)
    {
        $this->id = UlidService::generate();
        $this->test = $test;
        $this->description = $description;
        $this->type = $type;
        $this->answerOptions = new ArrayCollection();
        $this->name = $name;
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

    public function getTest(): Test
    {
        return $this->test;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPositionNumber(): ?int
    {
        return $this->positionNumber;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function getType(): QuestionType
    {
        return $this->type;
    }

    public function setPositionNumber(?int $positionNumber): void
    {
        $this->positionNumber = $positionNumber;
    }
}
