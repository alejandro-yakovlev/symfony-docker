<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSkillGroup;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Skills\Domain\Service\SkillGroupMaker;

readonly class CreateSkillGroupCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillGroupMaker $skillGroupMaker,
        private UserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(CreateSkillGroupCommand $command): CreateSkillGroupCommandResult
    {
        $skillGroup = $this->skillGroupMaker->make(
            $command->name,
            $this->userFetcher->requiredUser()->getId()
        );

        return new CreateSkillGroupCommandResult($skillGroup->getId());
    }
}
