<?php

namespace App\Testing\Infrastructure\EventHandler;

use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Event\EventHandlerInterface;
use App\Testing\Application\Query\FindTestingSession\FindTestingSessionQuery;
use App\Testing\Domain\Entity\TestingSession\TestingSession;
use App\Testing\Domain\Event\TestingSessionCompletedEvent;
use App\Testing\Infrastructure\Adapter\SkillsAdapter;

class TestingSessionCompletedEventHandler implements EventHandlerInterface
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly SkillsAdapter $skillsAdapter
    ) {
    }

    public function __invoke(TestingSessionCompletedEvent $event)
    {
        /** @var TestingSession $testingSession */
        $testingSession = $this->queryBus->execute(new FindTestingSessionQuery($event->testingSessionId));

        $this->skillsAdapter->confirmSpecialistSkill(
            $testingSession->getTest()->getSkillId(),
            $testingSession->getUser()->getId(),
            $testingSession->getTest()->getId(),
            $testingSession->getCorrectAnswersPercentage()
        );
    }
}
