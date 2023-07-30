<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\Test;

use App\Shared\Domain\Aggregate\Id;
use App\Shared\Domain\Service\AssertService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Test
{
    private string $id;

    /**
     * Создатель теста.
     */
    private string $creatorId;

    private string $name;

    private string $description;

    /**
     * Процент правильно отвеченных вопросов, чтобы тест считался успешно пройденным.
     */
    private int $correctAnswersPercentage = 0;

    private bool $isPublished = false;

    /**
     * Навык, который тестирует тест.
     */
    private string $skillId;

    /**
     * Уровень сложности.
     */
    private DifficultyLevel $difficultyLevel;

    /**
     * @var Collection<Question>
     */
    private Collection $questions;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $updatedAt = null;

    private ?\DateTimeImmutable $deletedAt = null;

    private string $testId;

    public function __construct(
        string $creatorId,
        string $name,
        string $description,
        DifficultyLevel $difficultyLevel,
        string $testId,
    ) {
        $this->id = Id::makeUlid();
        $this->creatorId = $creatorId;
        $this->name = $name;
        $this->description = $description;
        $this->questions = new ArrayCollection();
        $this->difficultyLevel = $difficultyLevel;
        $this->createdAt = new \DateTimeImmutable();
        $this->testId = $testId;
    }

    public function setCorrectAnswersPercentage(int $correctAnswersPercentage): self
    {
        AssertService::range($correctAnswersPercentage, 0, 100);
        $this->correctAnswersPercentage = $correctAnswersPercentage;

        return $this;
    }

    public function getCorrectAnswersPercentage(): int
    {
        return $this->correctAnswersPercentage;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSkillId(): ?string
    {
        return $this->skillId;
    }

    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): void
    {
        $this->questions->add($question);
    }
}
