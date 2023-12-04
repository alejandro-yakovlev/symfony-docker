<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\CreateSkill;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Skills\Domain\Service\SkillMaker;

readonly class CreateSkillCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillMaker $skillMaker,
        private UserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(CreateSkillCommand $command): CreateSkillCommandResult
    {
        $skill = $this->skillMaker->make(
            $command->name,
            $command->skillGroupId,
            $this->userFetcher->requiredUser()->getId()
        );

        return new CreateSkillCommandResult($skill->getId());
    }
}
