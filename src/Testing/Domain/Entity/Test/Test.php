<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\Test;

use App\Shared\Domain\Entity\ValueObject\GlobalUserId;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\ULIDService;
use App\Testing\Domain\Specification\TestSpecification;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Test
{
    private string $id;

    /**
     * Создатель теста.
     */
    private GlobalUserId $creator;

    private string $name;

    private string $description;

    /**
     * Процент правильно отвеченных вопросов, чтобы тест считался успешно пройденным.
     */
    private int $correctAnswersPercentage = 0;

    private bool $published = false;

    /**
     * Навык, который тестирует тест.
     */
    private ?string $skillId = null;

    /**
     * Уровень сложности.
     */
    private DifficultyLevel $difficultyLevel;

    /**
     * @var Collection<Question>
     */
    private Collection $questions;

    private DateTimeImmutable $createdAt;

    private ?DateTimeImmutable $updatedAt = null;

    private ?DateTimeImmutable $deletedAt = null;

    private TestSpecification $testSpecification;

    public function __construct(
        GlobalUserId $creator,
        string $name,
        string $description,
        DifficultyLevel $difficultyLevel,
        TestSpecification $testSpecification
    ) {
        $this->testSpecification = $testSpecification;
        $this->id = ULIDService::generate();
        $this->creator = $creator;
        $this->setName($name);
        $this->description = $description;
        $this->questions = new ArrayCollection();
        $this->difficultyLevel = $difficultyLevel;
        $this->createdAt = new DateTimeImmutable();
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function published(): bool
    {
        return $this->published;
    }

    public function getDifficultyLevel(): DifficultyLevel
    {
        return $this->difficultyLevel;
    }

    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): void
    {
        $this->questions->add($question);
    }

    public function setSkillId(?string $skillId): void
    {
        $this->skillId = $skillId;
    }

    private function setName(string $name): void
    {
        $this->name = $name;
        $this->testSpecification->uniqueTestNameSpecification->satisfy($this);
    }
}
