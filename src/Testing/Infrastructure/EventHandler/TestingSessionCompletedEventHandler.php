<?php

namespace App\Testing\Infrastructure\EventHandler;

use App\Shared\Application\Event\EventHandlerInterface;
use App\Testing\Application\QueryInteractor;
use App\Testing\Domain\Event\TestingSessionCompletedEvent;
use App\Testing\Infrastructure\Adapter\SkillsAdapter;

readonly class TestingSessionCompletedEventHandler implements EventHandlerInterface
{
    public function __construct(
        private SkillsAdapter $skillsAdapter,
        private QueryInteractor $queryInteractor
    ) {
    }

    public function __invoke(TestingSessionCompletedEvent $event): string
    {
        $testingSession = $this->queryInteractor
            ->findTestingSession($event->testingSessionId)
            ->testingSession;

        $this->skillsAdapter->confirmSpecialistSkill(
            $testingSession->skillId,
            $testingSession->userId,
            $testingSession->testId,
            $testingSession->correctAnswersPercentage
        );

        return $testingSession->id;
    }
}
