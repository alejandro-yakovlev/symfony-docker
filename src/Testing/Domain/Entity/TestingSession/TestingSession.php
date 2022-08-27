<?php

declare(strict_types=1);

namespace App\Testing\Domain\Entity\TestingSession;

use App\Shared\Domain\Entity\Aggregate;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\ULIDService;
use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Testing\Domain\Entity\Test\Test;
use App\Testing\Domain\Event\TestingSessionCompletedEvent;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Сессия тестирования пользователя.
 */
class TestingSession extends Aggregate
{
    private string $id;

    private GlobalUserId $user;

    private Test $test;

    private float $correctAnswersPercentage = 0;

    private ?bool $isPassedSuccessfully = null;

    /**
     * @var Collection<UserAnswer>
     */
    private Collection $userAnswers;

    private DateTimeInterface $startedAt;

    private ?DateTimeInterface $completedAt = null;

    public function __construct(Test $test, GlobalUserId $user)
    {
        $this->id = ULIDService::generate();
        $this->user = $user;
        $this->test = $test;
        $this->startedAt = new \DateTimeImmutable();
        $this->userAnswers = new ArrayCollection();
    }

    /**
     * Завершить сессию.
     */
    public function complete(): void
    {
        AssertService::null($this->completedAt, 'Тест уже завершен.');

        $this->completedAt = new DateTimeImmutable();

        // Количество правильных ответов.
        $correctAnswersNumber = 0;
        foreach ($this->userAnswers as $a) {
            if ($a->isCorrect()) {
                ++$correctAnswersNumber;
            }
        }

        // Подсчитываем процент правильных ответов.
        $this->correctAnswersPercentage = round(
            $correctAnswersNumber / $this->test->getQuestions()->count() * 100,
            2
        );

        // Тест считается успешно пройденным если реальный процент правильных ответов
        // равен или превышает значение порога, который установил автор теста
        $this->isPassedSuccessfully = $this->correctAnswersPercentage >= $this->test->getCorrectAnswersPercentage();

        $this->raise(new TestingSessionCompletedEvent($this->getId()));
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function addAnswer(UserAnswer $answer): void
    {
        foreach ($this->userAnswers as $a) {
            AssertService::true(
                $a->getQuestion()->getId() !== $answer->getQuestion()->getId(),
                'Ответ уже добавлен'
            );
        }

        $this->userAnswers->add($answer);

        // При добавлении последнего ответа на вопрос, завершаем тестирвоание.
        if ($this->userAnswers->count() === $this->test->getQuestions()->count()) {
            $this->complete();
        }
    }

    public function getCorrectAnswersPercentage(): float
    {
        return $this->correctAnswersPercentage;
    }

    public function getTest(): Test
    {
        return $this->test;
    }

    public function getUser(): GlobalUserId
    {
        return $this->user;
    }
}
